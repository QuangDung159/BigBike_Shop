<?php

namespace App\Http\Controllers;

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
}