<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\BrandCategory;
use App\Category;
use App\Constant;
use App\Gallery;
use App\Image;
use App\OrderProduct;
use App\Product;
use App\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @param int $productId
     * @return Factory|View
     */
    public function showProductDetailPage($productId)
    {
        $product = Product::getByIdClient($productId);

        $listImage = Image::getListImageByProductIdClient($productId);

        $listReview = (array)Review::getReviewByProductId($productId);

        return view(Constant::PATH_PRODUCT_DETAIL)
            ->with('product', $product)
            ->with('listImage', $listImage)
            ->with('listReview', $listReview);
    }

    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listProduct = Product::getAll()
            ->orderBy(Constant::TABLE_PRODUCT . '.product_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::getAll()->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_PRODUCT_LIST)
            ->with('listProduct', $listProduct)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    /**
     * @param int $productId
     * @param int $status
     * @return RedirectResponse
     */
    public function changeStatus($productId, $status)
    {
        $data = [];

        $gallery = Gallery::getGalleryByProductId($productId);
        if (!$gallery) {
            Session::put('msg_create_gallery_to_active', 'Please create gallery with this product to active.');
            Session::put('product_id_to_add_gallery', $productId);
            return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
        }

        if ($status == 0) {
            $data['product_status'] = 1;
        } else {
            $data['product_status'] = 0;
        }

        $data['product_updated_at'] = time();
        $data['product_updated_by'] = Session::get('admin_id');

        Product::updateByProductId($productId, $data);

        Session::put('msg_update_success', 'Update product successfully!');

        if (Session::get('product_id_after_create_gallery') != null) {
            Session::put('product_id_after_create_gallery', null);
        }
        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
    }

    /**
     * @param int $productId
     * @return RedirectResponse
     */
    public function deleteProduct($productId)
    {
        if (!$productId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        // check product belong to order with shipping status = delivered or canceled
        $listOrderProductContainProduct = OrderProduct::getListOrderContainProduct($productId);
        if ($listOrderProductContainProduct) {
            foreach ($listOrderProductContainProduct as $key => $order) {
                if ($order->shipping_status_id != 4 && $order->shipping_status_id != 5) {
                    Session::put('msg_order_contain', 'This product belong to order #' . $order->order_id . '. You cannot delete it!');
                    return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
                }
            }
        }

        $data = [
            Constant::TABLE_PRODUCT . '.product_is_deleted' => 1,
            Constant::TABLE_PRODUCT . '.product_updated_at' => time(),
            Constant::TABLE_PRODUCT . '.product_updated_by' => Session::get('admin_id'),
        ];

        // remove image of gallery
        $this->removeImageOfGalleryByProductId($productId);

        // remove gallery
        Gallery::removeByProductId($productId);

        // remove review by product
        Review::removeByProductId($productId);

        // delete product
        $product = Product::getById($productId);
        if (!$productId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }
        unlink(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE . $product->product_thumbnail);
        Product::updateByProductId($productId, $data);

        Session::put('msg_delete_success', 'Delete product successfully!');
        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function removeImageOfGalleryByProductId($productId)
    {
        $gallery = Gallery::getGalleryByProductId($productId);
        if (!$gallery) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $listImage = Image::getImageByGalleryId($gallery->gallery_id);
        if (!$listImage) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        foreach ($listImage as $key => $image) {
            unlink(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE . $image->image_path);
            Image::removeByImageId($image->image_id);
        }
    }

    /**
     * @return Factory|View
     */
    public function showCreateProductPage()
    {
        $listBrand = Brand::getAllByStatusIsDeleted();
        $listCategory = Category::getAllByStatusIsDeleted();
        return view(Constant::PATH_ADMIN_PRODUCT_CREATE)
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doCreateProduct(Request $req)
    {
        $this->validate(
            $req,
            [
                'product_name' => 'required',
                'product_desc' => 'required',
                'product_content' => 'required',
                'product_price' => 'required|between:1,1000',
                'product_promotion_price' => 'required|between:1,1000',
                'product_stock' => 'required|integer|between:1,100',
                'product_thumbnail' => 'required',

            ],
            [
                'product_name.required' => 'Please enter product name',
                'product_desc.required' => 'Please enter product description',
                'product_content.required' => 'Please enter product content',
                'product_price.required' => 'Please enter product price',
                'product_promotion_price.required' => 'Please enter product promotion price',
                'product_stock.required' => 'Please enter product stock',
                'product_price.between' => 'Product price must be between 1 - 1000',
                'product_promotion_price.between' => 'Product promotion price must be between 1 - 1000',
                'product_stock.integer' => 'Product stock must be integer',
                'product_stock.between' => 'Product stock must be between 1 - 100',
                'product_thumbnail.required' => 'Please choose thumbnail',
            ]
        );

        $productName = $req->product_name;
        $productDesc = $req->product_desc;
        $productContent = $req->product_content;
        $productPrice = $req->product_price;
        $productPromotionPrice = $req->product_promotion_price;
        $productStock = $req->product_stock;
        $brandId = $req->brand_id;
        $categoryId = $req->category_id;
        $thumbnail = $req->file('product_thumbnail');

        $productGetByName = Product::getProductByName($productName);
        if ($productGetByName) {
            Session::put('msg_name_existed', 'Product name was existed');
            return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/create');
        }

        $brandCategory = BrandCategory::getByBrandIdCategoryId($brandId, $categoryId);
        if (!$brandCategory) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }
        $brandCategoryId = $brandCategory->brand_category_id;

        $data = [
            'product_name' => $productName,
            'product_desc' => $productDesc,
            'product_content' => $productContent,
            'product_price' => $productPrice,
            'product_promotion_price' => $productPromotionPrice,
            'product_stock' => $productStock,
            'product_created_at' => time(),
            'product_created_by' => Session::get('admin_id'),
            'brand_category_id' => $brandCategoryId,
            'product_rate' => 0,
            'product_status' => 0,
        ];

        if ($thumbnail) {
            $newName = time() . '_' . rand(0, 9) . '_' . $req->product_name . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE, $newName);
            $data['product_thumbnail'] = $newName;
        }

        Product::insert($data);

        Session::put('msg_add_success', 'Create product successfully!');

        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
    }

    /**
     * @param int $productId
     * @return Factory|RedirectResponse|View
     */
    public function showDetailPage($productId)
    {
        if (!$productId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $product = Product::getById($productId);
        if (!$product) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $brandCategory = BrandCategory::getBrandNameCategoryNameById($product->brand_category_id);
        if (!$brandCategory) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $listImage = Image::getListImageByProductIdClient($productId);
        if (!$listImage) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        return view(Constant::PATH_ADMIN_PRODUCT_DETAIL)
            ->with('product', $product)
            ->with('brandCategory', $brandCategory)
            ->with('listImage', $listImage);
    }

    /**
     * @param int $productId
     * @return Factory|RedirectResponse|View
     */
    public function showEditPage($productId)
    {
        if (!$productId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $product = Product::getById($productId);
        if (!$product) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $brandCategory = BrandCategory::getBrandNameCategoryNameById($product->brand_category_id);

        $listBrand = Brand::getAllByStatusIsDeleted();
        $listCategory = Category::getAllByStatusIsDeleted();

        $listImage = Image::getListImageByProductIdClient($productId);
        if (!$listImage) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $gallery = Gallery::getGalleryByProductId($productId);
        if (!$gallery) {
            Session::put('msg_create_gallery_to_active', 'Please create gallery with this product to edit.');
            Session::put('product_id_to_add_gallery', $productId);
            return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
        }

        return view(Constant::PATH_ADMIN_PRODUCT_EDIT)
            ->with('product', $product)
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory)
            ->with('listImage', $listImage)
            ->with('gallery', $gallery)
            ->with('brandCategory', $brandCategory);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doEditProduct(Request $req)
    {
        $this->validate(
            $req,
            [
                'product_name' => 'required',
                'product_desc' => 'required',
                'product_content' => 'required',
                'product_price' => 'required|between:1,1000',
                'product_promotion_price' => 'required|between:1,1000',
                'product_stock' => 'required|integer|between:1,100',

            ],
            [
                'product_name.required' => 'Please enter product name',
                'product_desc.required' => 'Please enter product description',
                'product_content.required' => 'Please enter product content',
                'product_price.required' => 'Please enter product price',
                'product_promotion_price.required' => 'Please enter product promotion price',
                'product_stock.required' => 'Please enter product stock',
                'product_price.between' => 'Product price must be between 1 - 1000',
                'product_promotion_price.between' => 'Product promotion price must be between 1 - 1000',
                'product_stock.integer' => 'Product stock must be integer',
                'product_stock.between' => 'Product stock must be between 1 - 100',
            ]
        );

        $productId = $req->product_id;
        $productName = $req->product_name;
        $productDesc = $req->product_desc;
        $productContent = $req->product_content;
        $productPrice = $req->product_price;
        $productPromotionPrice = $req->product_promotion_price;
        $productStock = $req->product_stock;
        $brandId = $req->brand_id;
        $categoryId = $req->category_id;
        $thumbnail = $req->file('product_thumbnail');

        $productGetByName = Product::getProductByName($productName);
        if ($productGetByName && $productGetByName->product_id != $productId) {
            Session::put('msg_name_existed', 'Product name was existed');
            return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/update/' . $productId);
        }

        $brandCategory = BrandCategory::getByBrandIdCategoryId($brandId, $categoryId);
        if (!$brandCategory) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }
        $brandCategoryId = $brandCategory->brand_category_id;

        $data = [
            'product_name' => $productName,
            'product_desc' => $productDesc,
            'product_content' => $productContent,
            'product_price' => $productPrice,
            'product_promotion_price' => $productPromotionPrice,
            'product_stock' => $productStock,
            'product_updated_at' => time(),
            'product_updated_by' => Session::get('admin_id'),
            'brand_category_id' => $brandCategoryId,
            'product_rate' => 0,
        ];

        $productById = Product::getById($productId);
        if (!$productById) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        if ($thumbnail) {
            $oldImage = $productById->product_thumbnail;
            unlink(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE . $oldImage);
            $newName = time() . '_' . rand(0, 9) . '_' . $req->product_name . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE, $newName);
            $data['product_thumbnail'] = $newName;
        }

        Product::updateByProductId($productId, $data);

        Session::put('msg_update_success', 'Update product successfully!');

        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read/detail/' . $productId);
    }
}
