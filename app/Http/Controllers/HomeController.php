<?php

namespace App\Http\Controllers;

use App\Product;
use App\Slide;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Constant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $listFeatureProduct = Product::getFeatureProduct();

        $listSlide = Slide::get();

        Session::put('test', 'test');

        return view(Constant::PATH_HOME)
            ->with('listFeatureProduct', $listFeatureProduct)
            ->with('listSlide', $listSlide);
    }
}
