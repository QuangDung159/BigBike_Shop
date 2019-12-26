<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\Constant;
use App\Gallery;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function showListPage()
    {
        $listGallery = Gallery::getAll();

        $listAdmin = Admin::where(
            Constant::TABLE_ADMIN . '.admin_is_deleted',
            '=',
            0
        )->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_GALLERY_LIST)
            ->with('listGallery', $listGallery)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    public function showCreateGalleryPage()
    {
        $listProduct = Product::getListProductWithoutGallery();
        return view(Constant::PATH_ADMIN_GALLERY_CREATE)
            ->with('listProduct', $listProduct);
    }

    public function doCreateGallery(Request $req)
    {
        $this->validate(
            $req,
            [
                'gallery_name' => 'required',
                'image_path_1' => 'required',
                'image_path_2' => 'required',
                'image_path_3' => 'required',
                'product_id' => 'required',
            ],
            [
                'gallery_name.required' => 'Please enter gallery name',
                'image_path_1.required' => 'Please choose image 1',
                'image_path_2.required' => 'Please choose image 2',
                'image_path_3.required' => 'Please choose image 3',
                'product_id.required' => 'Please choose product name',
            ]
        );

        $galleryName = $req->gallery_name;
        $productId = $req->product_id;

        $galleryData = [];
        $galleryData['gallery_name'] = $galleryName;
        $galleryData['product_id'] = $productId;
        $galleryData['gallery_created_at'] = time();
        $galleryData['gallery_created_by'] = Session::get('admin_id');
        $galleryId = Gallery::insertGetId($galleryData);

        $image1 = $req->file('image_path_1');
        $imageData1 = $this->createImageDataArray(
            $this->getNameAndMoveImage($image1),
            $galleryId,
            time(),
            Session::get('admin_id')
        );

        $image2 = $req->file('image_path_2');
        $imageData2 = $this->createImageDataArray(
            $this->getNameAndMoveImage($image2),
            $galleryId,
            time(),
            Session::get('admin_id')
        );

        $image3 = $req->file('image_path_3');
        $imageData3 = $this->createImageDataArray(
            $this->getNameAndMoveImage($image3),
            $galleryId,
            time(),
            Session::get('admin_id')
        );

        $arrImageData = [
            $imageData1,
            $imageData2,
            $imageData3
        ];

        Image::insert($arrImageData);

        Session::put('msg_add_success', 'Create brand successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND_GALLERY . '/read');
    }

    public function showDetailPage($brandId)
    {
        $brand = Brand::where(
            Constant::TABLE_BRAND . '.brand_id',
            '=',
            $brandId
        )->where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->first();

        return view(Constant::PATH_ADMIN_BRAND_DETAIL)
            ->with('brand', $brand);
    }

    public function showEditPage($brandId)
    {
        $brand = Brand::where(
            Constant::TABLE_BRAND . '.brand_id',
            '=',
            $brandId
        )->where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->first();

        return view(Constant::PATH_ADMIN_BRAND_EDIT)
            ->with('brand', $brand);
    }

    public function doEditBrand(Request $req)
    {
        $this->validate(
            $req,
            [
                'brand_name' => 'required',
                'brand_description' => 'required',
            ],
            [
                'brand_name.required' => 'Please enter brand name',
                'brand_description.required' => 'Please enter brand description',
            ]
        );

        $brandName = $req->brand_name;
        $brandDesc = $req->brand_description;
        $brandId = $req->brand_id;
        $image = $req->file('brand_logo');

        $data = [
            'brand_name' => $brandName,
            'brand_desc' => $brandDesc,
            'brand_updated_by' => 1,
            'brand_updated_at' => time()
        ];

        if ($image) {
            $newName = time() . '_' . rand(0, 9) . '_' . $req->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . Constant::PATH_TO_UPLOAD_LOGO, $newName);
            $data['brand_logo'] = $newName;
        }

        Brand::updateByBrandId($brandId, $data);

        Session::put('msg_update_success', 'Update brand successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND . '/read/detail/' . $brandId);
    }

    /**
     * @param string $imagePath
     * @param int $galleryId
     * @param int $createdAt
     * @param int $createdBy
     * @return array
     */
    public function createImageDataArray($imagePath, $galleryId, $createdAt, $createdBy)
    {
        $data = [];
        $data['image_path'] = $imagePath;
        $data['gallery_id'] = $galleryId;
        $data['image_created_at'] = $createdAt;
        $data['image_created_by'] = $createdBy;
        return $data;
    }

    /**
     * @param $image
     * @return string
     */
    public function getNameAndMoveImage($image)
    {
        $newName = time() . '_' . rand(0, 99) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path() . Constant::PATH_TO_UPLOAD_LOGO, $newName);
        return $newName;
    }
}
