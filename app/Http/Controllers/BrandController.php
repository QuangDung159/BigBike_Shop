<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function showListPage()
    {
        $listBrand = Brand::where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->paginate(10);

        $listAdmin = Admin::where(
            Constant::TABLE_ADMIN . '.admin_is_deleted',
            '=',
            0
        )->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_BRAND_LIST)
            ->with('listBrand', $listBrand)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    public function deleteBrand($brandId)
    {
        $data = [
            Constant::TABLE_BRAND . '.brand_is_deleted' => 1,
            Constant::TABLE_BRAND . '.brand_updated_at' => time(),
            Constant::TABLE_BRAND . '.brand_updated_by' => 1
        ];

        Brand::updateByBrandId($brandId, $data);

        return Redirect::to(Constant::URL_ADMIN_BRAND . '/list');
    }

    public function showCreateBrandPage()
    {
        return view(Constant::PATH_ADMIN_BRAND_CREATE);
    }
}
