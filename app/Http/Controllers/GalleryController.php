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
            $this->getNameAndMoveImage($image1, 1),
            $galleryId,
            time(),
            Session::get('admin_id')
        );

        $image2 = $req->file('image_path_2');
        $imageData2 = $this->createImageDataArray(
            $this->getNameAndMoveImage($image2, 2),
            $galleryId,
            time(),
            Session::get('admin_id')
        );

        $image3 = $req->file('image_path_3');
        $imageData3 = $this->createImageDataArray(
            $this->getNameAndMoveImage($image3, 3),
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

        return Redirect::to(Constant::URL_ADMIN_GALLERY . '/read');
    }

    public function showDetailPage($galleryId)
    {
        $gallery = Gallery::getGalleryProductById($galleryId);
        $listImage = Image::getImageByGalleryId($galleryId);

        return view(Constant::PATH_ADMIN_GALLERY_DETAIL)
            ->with('gallery', $gallery)
            ->with('listImage', $listImage);
    }

    public function showEditPage($galleryId)
    {
        $gallery = Gallery::getGalleryProductById($galleryId);
        $listProduct = Product::getListProductWithoutGallery();
        $listImage = Image::getImageByGalleryId($galleryId);

        return view(Constant::PATH_ADMIN_GALLERY_EDIT)
            ->with('gallery', $gallery)
            ->with('listProduct', $listProduct)
            ->with('listImage', $listImage);
    }

    public function doEditGallery(Request $req)
    {
        $this->validate(
            $req,
            [
                'gallery_name' => 'required',
            ],
            [
                'gallery_name.required' => 'Please enter gallery name',
            ]
        );

        $galleryName = $req->gallery_name;
        $productId = $req->product_id;
        $galleryId = $req->gallery_id;

        $galleryData = [];
        $galleryData['gallery_name'] = $galleryName;
        $galleryData['product_id'] = $productId;
        $galleryData['gallery_updated_at'] = time();
        $galleryData['gallery_updated_by'] = Session::get('admin_id');

        Gallery::updateById($galleryId, $galleryData);

        // image
        $this->updateRemoveImageByGalleryId($req, $galleryId);

        Session::put('msg_update_success', 'Update gallery successfully!');

        return Redirect::to(Constant::URL_ADMIN_GALLERY . '/read/detail/' . $galleryId);
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
     * @param int $counter
     * @return string
     */
    public function getNameAndMoveImage($image, $counter)
    {
        $newName = time() . '_' . rand(0, 99) . '_' . $counter . '.' . $image->getClientOriginalExtension();
        $image->move(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE, $newName);
        return $newName;
    }

    /**
     * @param int $imageId
     */
    public function removeImageFileById($imageId)
    {
        $currentImage = Image::getById($imageId);
        $currentImageName = $currentImage->image_path;
        unlink(public_path() . Constant::PATH_TO_UPLOAD_PRODUCT_IMAGE . $currentImageName);
    }

    /**
     * @param Request $req
     * @param int $galleryId
     */
    public function updateRemoveImageByGalleryId(Request $req, $galleryId)
    {
        $image1 = $req->file('image_path_1');
        if ($image1) {
            $imageId1 = $req->image_id_1;
            $imageData1 = $this->createImageDataArray(
                $this->getNameAndMoveImage($image1, 1),
                $galleryId,
                time(),
                Session::get('admin_id')
            );

            $this->removeImageFileById($imageId1);

            Image::updateById($imageId1, $imageData1);
        }

        $image2 = $req->file('image_path_2');
        if ($image2) {
            $imageId2 = $req->image_id_2;
            $imageData2 = $this->createImageDataArray(
                $this->getNameAndMoveImage($image2, 2),
                $galleryId,
                time(),
                Session::get('admin_id')
            );

            $this->removeImageFileById($imageId2);

            Image::updateById($imageId2, $imageData2);
        }

        $image3 = $req->file('image_path_3');
        if ($image3) {
            $imageId3 = $req->image_id_3;
            $imageData3 = $this->createImageDataArray(
                $this->getNameAndMoveImage($image3, 3),
                $galleryId,
                time(),
                Session::get('admin_id')
            );

            $this->removeImageFileById($imageId3);

            Image::updateById($imageId3, $imageData3);
        }
    }
}
