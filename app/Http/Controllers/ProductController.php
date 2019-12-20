<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Image;
use App\Product;
use App\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductDetailPage($productId)
    {
        $product = Product::getProductByIdClient($productId);

        $listImage = Image::getListImageByProductIdClient($productId);

        $listReview = (array)Review::getReviewByProductId($productId);

        return view(Constant::PATH_PRODUCT_DETAIL)
            ->with('product', $product)
            ->with('listImage', $listImage)
            ->with('listReview', $listReview);
    }
}
