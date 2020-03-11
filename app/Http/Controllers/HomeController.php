<?php

namespace App\Http\Controllers;

use App\Brand;
use App\BrandCategory;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Constant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showHomePage()
    {
        $listBrandCategory = BrandCategory::getAll();
        $listBrandCategory = $this->createBrandCategoryArr($listBrandCategory);

        return view(Constant::PATH_HOME)
            ->with('listBrandCategory', $listBrandCategory);
    }

    /**
     * @return Factory|View
     */
    public function showAdminDashboard()
    {
        return view(Constant::PATH_ADMIN_DASHBOARD);
    }

    /**
     * @param $listBrandCategory
     * @return mixed
     */
    public function createBrandCategoryArr($listBrandCategory)
    {
        $arrBrandCategory = HelperController::convertStdToArray($listBrandCategory);
        $arrResult = [];
        foreach ($arrBrandCategory as $brandCat) {
            $arrResult[$brandCat['brand_name']][] = [
                $brandCat['category_name'],
                $brandCat['category_id'],
                $brandCat['brand_category_id'],
                Product::get5NewestProductByBrandName($brandCat['brand_name']),
            ];
        }

        return HelperController::convertArrayToStd($arrResult);
    }
}
