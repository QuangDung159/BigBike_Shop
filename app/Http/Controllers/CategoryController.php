<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\Category;
use App\Constant;
use App\Image;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function showCategoryPage($categoryId, $brandId, Request $req)
    {
        $sortType = $req->sort_type;
        $itemPerPage = $req->item_per_page;

        $listProduct = Product::getProductClient($categoryId, $brandId, $sortType, $itemPerPage);

        $category = Category::getById($categoryId);

        $listCategory = Category::where(
            Constant::TABLE_CATEGORY . '.category_status',
            '=',
            1
        )->where(
            Constant::TABLE_CATEGORY . '.category_is_deleted',
            '=',
            0
        )->get();

        $listBrand = Brand::where(
            Constant::TABLE_BRAND . '.brand_status',
            '=',
            1
        )->where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->get();

        $brand = Brand::where(
            Constant::TABLE_BRAND . '.brand_id',
            '=',
            $brandId
        )->first();

        $param = [
            'sort_type' => $sortType,
            'item_per_page' => $itemPerPage
        ];

        $url = HelperController::buildUrlWithParams($param);

        $listProduct->withPath($brandId . $url);

        $listSort = json_decode(Redis::get('list_sort'));
        $listPerPage = json_decode(Redis::get('list_per_page'));

        return view(Constant::PATH_CATEGORY)
            ->with('listProduct', $listProduct)
            ->with('category', $category)
            ->with('listCategory', $listCategory)
            ->with('listBrand', $listBrand)
            ->with('brand', $brand)
            ->with('listSort', $listSort)
            ->with('listPerPage', $listPerPage)
            ->with('sortType', $sortType)
            ->with('itemPerPage', $itemPerPage);
    }

    public function showListPage()
    {
        $listCategory = Category::where(
            Constant::TABLE_CATEGORY . '.category_is_deleted',
            '=',
            0
        )->orderBy(Constant::TABLE_CATEGORY . '.category_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::getAll()->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_CATEGORY_LIST)
            ->with('listCategory', $listCategory)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    public function deleteCategory($categoryId)
    {
        $data = [
            Constant::TABLE_CATEGORY . '.category_is_deleted' => 1,
            Constant::TABLE_CATEGORY . '.category_updated_at' => time(),
            Constant::TABLE_CATEGORY . '.category_updated_by' => 1
        ];

        Category::updateByCategoryId($categoryId, $data);

        Session::put('msg_delete_success', 'Delete category successfully!');

        return Redirect::to(Constant::URL_ADMIN_CATEGORY . '/read');
    }

    public function showCreateCategoryPage()
    {
        return view(Constant::PATH_ADMIN_CATEGORY_CREATE);
    }

    public function doCreateCategory(Request $req)
    {
        $this->validate(
            $req,
            [
                'category_name' => 'required',
                'category_description' => 'required',
            ],
            [
                'category_name.required' => 'Please enter category name',
                'category_description.required' => 'Please enter category description',
            ]
        );

        $categoryName = $req->category_name;
        $categoryDesc = $req->category_description;

        $data = [
            'category_name' => $categoryName,
            'category_desc' => $categoryDesc,
            'category_created_by' => 1,
            'category_created_at' => time()
        ];

        Category::insert($data);

        Session::put('msg_add_success', 'Create category successfully!');

        return Redirect::to(Constant::URL_ADMIN_CATEGORY . '/read');
    }

    public function changeStatus($categoryId, $status)
    {
        $data = [];
        if ($status == 0) {
            $data['category_status'] = 1;
        } else {
            $data['category_status'] = 0;
        }

        $data['category_updated_at'] = time();
        $data['category_updated_by'] = 1;

        Category::updateByCategoryId($categoryId, $data);

        Session::put('msg_update_success', 'Update category successfully!');
        return Redirect::to(Constant::URL_ADMIN_CATEGORY . '/read');
    }

    public function showDetailPage($categoryId)
    {
        $category = Category::where(
            Constant::TABLE_CATEGORY . '.category_id',
            '=',
            $categoryId
        )->where(
            Constant::TABLE_CATEGORY . '.category_is_deleted',
            '=',
            0
        )->first();

        return view(Constant::PATH_ADMIN_CATEGORY_DETAIL)
            ->with('category', $category);
    }

    public function showEditPage($categoryId)
    {
        $category = Category::where(
            Constant::TABLE_CATEGORY . '.category_id',
            '=',
            $categoryId
        )->where(
            Constant::TABLE_CATEGORY . '.category_is_deleted',
            '=',
            0
        )->first();

        return view(Constant::PATH_ADMIN_CATEGORY_EDIT)
            ->with('category', $category);
    }

    public function doEditCategory(Request $req)
    {
        $this->validate(
            $req,
            [
                'category_name' => 'required',
                'category_description' => 'required',
            ],
            [
                'category_name.required' => 'Please enter category name',
                'category_description.required' => 'Please enter category description',
            ]
        );

        $categoryName = $req->category_name;
        $categoryDesc = $req->category_description;
        $categoryId = $req->category_id;

        $data = [
            'category_name' => $categoryName,
            'category_desc' => $categoryDesc,
            'category_updated_by' => 1,
            'category_updated_at' => time()
        ];

        Category::updateByCategoryId($categoryId, $data);

        Session::put('msg_update_success', 'Update category successfully!');

        return Redirect::to(Constant::URL_ADMIN_CATEGORY . '/read/detail/' . $categoryId);
    }
}
