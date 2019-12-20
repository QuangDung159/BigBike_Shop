<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Image;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategoryPage($categoryId)
    {
        $listProduct = Product::getProductByCategoryClient($categoryId);
        if (!$listProduct) {
            $listProduct = [];
        }


        return view(Constant::PATH_CATEGORY)
            ->with('listProduct', $listProduct);
    }
}
