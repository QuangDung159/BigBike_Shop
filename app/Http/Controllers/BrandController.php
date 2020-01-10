<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\Constant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BrandController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listBrand = Brand::where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->orderBy(Constant::TABLE_BRAND . '.brand_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::getAll()->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_BRAND_LIST)
            ->with('listBrand', $listBrand)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    /**
     * @param int $brandId
     * @return RedirectResponse
     */
    public function deleteBrand($brandId)
    {
        $data = [
            Constant::TABLE_BRAND . '.brand_is_deleted' => 1,
            Constant::TABLE_BRAND . '.brand_updated_at' => time(),
            Constant::TABLE_BRAND . '.brand_updated_by' => 1
        ];

        Brand::updateByBrandId($brandId, $data);

        Session::put('msg_delete_success', 'Delete brand successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND . '/read');
    }

    /**
     * @return Factory|View
     */
    public function showCreateBrandPage()
    {
        return view(Constant::PATH_ADMIN_BRAND_CREATE);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doCreateBrand(Request $req)
    {
        $this->validate(
            $req,
            [
                'brand_name' => 'required',
                'brand_description' => 'required',
                'brand_logo' => 'required'
            ],
            [
                'brand_name.required' => 'Please enter brand name',
                'brand_description.required' => 'Please enter brand description',
                'brand_logo.required' => 'Please choose logo'
            ]
        );

        $brandName = $req->brand_name;
        $brandDesc = $req->brand_description;
        $image = $req->file('brand_logo');

        $data = [
            'brand_name' => $brandName,
            'brand_desc' => $brandDesc,
            'brand_created_by' => 1,
            'brand_created_at' => time()
        ];

        if ($image) {
            $newName = time() . '_' . rand(0, 9) . '_' . $req->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . Constant::PATH_TO_UPLOAD_LOGO, $newName);
            $data['brand_logo'] = $newName;
        }

        Brand::insert($data);

        Session::put('msg_add_success', 'Create brand successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND . '/read');
    }

    /**
     * @param $brandId
     * @param $status
     * @return RedirectResponse
     */
    public function changeStatus($brandId, $status)
    {
        $data = [];
        if ($status == 0) {
            $data['brand_status'] = 1;
        } else {
            $data['brand_status'] = 0;
        }

        $data['brand_updated_at'] = time();
        $data['brand_updated_by'] = 1;

        Brand::updateByBrandId($brandId, $data);

        Session::put('msg_update_success', 'Update brand successfully!');
        return Redirect::to(Constant::URL_ADMIN_BRAND . '/read');
    }

    /**
     * @param int $brandId
     * @return Factory|View
     */
    public function showDetailPage($brandId)
    {
        $brand = Brand::where(
            Constant::TABLE_BRAND . '.brand_id',
            '=',
            $brandId
        )->where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->first();

        return view(Constant::PATH_ADMIN_BRAND_DETAIL)
            ->with('brand', $brand);
    }

    /**
     * @param int $brandId
     * @return Factory|View
     */
    public function showEditPage($brandId)
    {
        $brand = Brand::where(
            Constant::TABLE_BRAND . '.brand_id',
            '=',
            $brandId
        )->where(
            Constant::TABLE_BRAND . '.brand_is_deleted',
            '=',
            0
        )->first();

        return view(Constant::PATH_ADMIN_BRAND_EDIT)
            ->with('brand', $brand);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doEditBrand(Request $req)
    {
        $this->validate(
            $req,
            [
                'brand_name' => 'required',
                'brand_description' => 'required',
            ],
            [
                'brand_name.required' => 'Please enter brand name',
                'brand_description.required' => 'Please enter brand description',
            ]
        );

        $brandName = $req->brand_name;
        $brandDesc = $req->brand_description;
        $brandId = $req->brand_id;
        $image = $req->file('brand_logo');

        $data = [
            'brand_name' => $brandName,
            'brand_desc' => $brandDesc,
            'brand_updated_by' => 1,
            'brand_updated_at' => time()
        ];

        if ($image) {
            $newName = time() . '_' . rand(0, 9) . '_' . $req->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . Constant::PATH_TO_UPLOAD_LOGO, $newName);
            $data['brand_logo'] = $newName;
        }

        Brand::updateByBrandId($brandId, $data);

        Session::put('msg_update_success', 'Update brand successfully!');

        return Redirect::to(Constant::URL_ADMIN_BRAND . '/read/detail/' . $brandId);
    }
}
