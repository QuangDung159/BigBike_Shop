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

        $listFeatureProduct = HelperController::convertStdToArray($listFeatureProduct);

        $listFeatureProduct = HelperController::uniqueMultiFieldArray($listFeatureProduct, 'product_name');

        $listFeatureProduct = array_slice($listFeatureProduct, 0, 10);

        $listFeatureProduct = HelperController::convertArrayToStd($listFeatureProduct);

        $listSlide = Slide::get();

        return view(Constant::PATH_HOME)
            ->with('listFeatureProduct', $listFeatureProduct)
            ->with('listSlide', $listSlide);
    }
}
