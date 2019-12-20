<?php

namespace App\Http\Controllers;

use App\Product;
use App\Slide;
use Illuminate\Http\Request;
use App\Constant;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $listFeatureProduct = Product::getFeatureProduct();

        $listSlide = Slide::get();

        return view(Constant::PATH_HOME)
            ->with('listFeatureProduct', $listFeatureProduct)
            ->with('listSlide', $listSlide);
    }
}
