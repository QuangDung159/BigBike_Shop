<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\BrandCategory;
use App\Category;
use App\Constant;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class BrandCategoryController extends Controller
{
    public function showListPage()
    {
        $listBrandCategory = BrandCategory::getBrandCategory();

        $listAdmin = Admin::getAll()->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_BRAND_CATEGORY_LIST)
            ->with('listBrandCategory', $listBrandCategory)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    public function deleteBrandCategory($brandCategoryId)
    {
        $data = [
            Constant::TABLE_BRAND_CATEGORY . '.brand_category_is_deleted' => 1,
            Constant::TABLE_BRAND_CATEGORY . '.brand_category_updated_at' => time(),
            Constant::TABLE_BRAND_CATEGORY . '.brand_category_updated_by' => Session::get('admin_id'),
        ];

        BrandCategory::updateByBrandCategoryId($brandCategoryId, $data);

        Session::put('msg_delete_success', 'Delete brand - category successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND_CATEGORY . '/read');
    }

    public function showCreateBrandCategoryPage()
    {
        $listBrand = Brand::getAllByStatusIsDeleted();
        $listCategory = Category::getAllByStatusIsDeleted();

        return view(Constant::PATH_ADMIN_BRAND_CATEGORY_CREATE)
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory);
    }

    public function doCreateBrandCategory(Request $req)
    {
        $this->validate(
            $req,
            [
                'category_id' => 'required',
                'brand_id' => 'required',
            ],
            [
                'category_id.required' => 'Please choose category name',
                'brand_id.required' => 'Please choose brand name',
            ]
        );

        $categoryId = $req->category_id;
        $brandId = $req->brand_id;

        $brandCategory = BrandCategory::getByBrandIdCategoryId($brandId, $categoryId);

        if ($brandCategory) {
            Session::put('msg_exist', 'Brand - Category was existed.');
            return Redirect::to(Constant::URL_ADMIN_BRAND_CATEGORY . '/create');
        }

        $data = [
            'brand_id' => $brandId,
            'category_id' => $categoryId,
            'brand_category_created_by' => Session::get('admin_id'),
            'brand_category_created_at' => time()
        ];

        BrandCategory::insert($data);

        Session::put('msg_add_success', 'Create brand - category successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND_CATEGORY . '/read');
    }

    public function changeStatus($brandCategoryId, $status)
    {
        $data = [];
        if ($status == 0) {
            $data['brand_category_status'] = 1;
        } else {
            $data['brand_category_status'] = 0;
        }

        $data['brand_category_updated_at'] = time();
        $data['brand_category_updated_by'] = 1;

        BrandCategory::updateByBrandCategoryId($brandCategoryId, $data);

        Session::put('msg_update_success', 'Update brand - category successfully!');
        return Redirect::to(Constant::URL_ADMIN_BRAND_CATEGORY . '/read');
    }

//    public function showDetailPage($categoryId)
//    {
//        $category = Category::where(
//            Constant::TABLE_CATEGORY . '.category_id',
//            '=',
//            $categoryId
//        )->where(
//            Constant::TABLE_CATEGORY . '.category_is_deleted',
//            '=',
//            0
//        )->first();
//
//        return view(Constant::PATH_ADMIN_CATEGORY_DETAIL)
//            ->with('category', $category);
//    }

    public function showEditPage($brandCategoryId)
    {
        $brandCategory = BrandCategory::getBrandNameCategoryNameById($brandCategoryId);

        $listBrand = Brand::getAllByStatusIsDeleted();
        $listCategory = Category::getAllByStatusIsDeleted();

        return view(Constant::PATH_ADMIN_BRAND_CATEGORY_EDIT)
            ->with('brandCategory', $brandCategory)
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory);
    }

    public function doEditBrandCategory(Request $req)
    {
        $brandId = $req->brand_id;
        $categoryId = $req->category_id;
        $brandCategoryId = $req->brand_category_id;

        $brandCategory = BrandCategory::getByBrandIdCategoryId($brandId, $categoryId);

        if (!$brandCategory || $brandCategory->brand_category_id == $brandCategoryId) {
            $data = [];
            $data['brand_id'] = $brandId;
            $data['category_id'] = $categoryId;
            $data['brand_category_updated_at'] = time();
            $data['brand_category_updated_by'] = Session::get('admin_id');

            BrandCategory::updateByBrandCategoryId($brandCategoryId, $data);
            Session::put('msg_update_success', 'Update category successfully!');
            return Redirect::to(Constant::URL_ADMIN_BRAND_CATEGORY . '/read');
        } else {
            Session::put('msg_exist', 'Brand - Category was existed.');
            return Redirect::to(Constant::URL_ADMIN_BRAND_CATEGORY . '/update/' . $brandCategoryId);
        }
    }
}
