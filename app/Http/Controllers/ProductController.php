<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\BrandCategory;
use App\Category;
use App\Constant;
use App\Image;
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

        $listAdmin = Admin::where(
            Constant::TABLE_ADMIN . '.admin_is_deleted',
            '=',
            0
        )->get();

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
        if ($status == 0) {
            $data['product_status'] = 1;
        } else {
            $data['product_status'] = 0;
        }

        $data['product_updated_at'] = time();
        $data['product_updated_by'] = Session::get('admin_id');

        Product::updateByProductId($productId, $data);

        Session::put('msg_update_success', 'Update product successfully!');
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

        $data = [
            Constant::TABLE_PRODUCT . '.product_is_deleted' => 1,
            Constant::TABLE_PRODUCT . '.product_updated_at' => time(),
            Constant::TABLE_PRODUCT . '.product_updated_by' => Session::get('admin_id'),
        ];

        Product::updateByProductId($productId, $data);

        Session::put('msg_delete_success', 'Delete product successfully!');

        return Redirect::to(Constant::URL_ADMIN_PRODUCT . '/read');
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
}
