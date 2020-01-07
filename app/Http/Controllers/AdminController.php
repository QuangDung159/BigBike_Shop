<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Constant;
use App\Gallery;
use App\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showAdminLoginPage()
    {
        return view(Constant::PATH_ADMIN_ADMIN_LOGIN);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doLogin(Request $req)
    {
        $adminEmail = $req->admin_email;
        $adminPassword = $req->admin_password;

        $this->validate($req,
            [
                'admin_email' => 'required',
                'admin_password' => 'required'
            ],
            [
                'admin_email.required' => 'Please enter your email',
                'admin_password' => 'Please enter your password'
            ]
        );

        $admin = Admin::getAdminByEmailPassword($adminEmail, $adminPassword);
        if ($admin) {
            Session::put('admin_id', $admin->admin_id);
            Return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        } else {
            Session::put('msg_login_fail', 'Login fail! Please check your information.');
            return Redirect::to(Constant::URL_ADMIN_LOGIN);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function doLogout()
    {
        Session::forget('admin_id');
        return Redirect::to(Constant::URL_ADMIN_LOGIN);
    }

    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listAdminToShow = Admin::getAll()
            ->orderBy(Constant::TABLE_ADMIN . '.admin_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::getAll()->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_ADMIN_LIST)
            ->with('listAdminToShow', $listAdminToShow)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    /**
     * @param int $adminId
     * @param int $status
     * @return RedirectResponse
     */
    public function changeStatus($adminId, $status)
    {
        $data = [];

        if ($status == 0) {
            $data['admin_status'] = 1;
        } else {
            $data['admin_status'] = 0;
        }

        if ($adminId == Session::get('admin_id')) {
            Session::put('msg_cannot_update_status_yourself', 'Sorry, you cannot update your status.');
            return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
        }

        $data['admin_updated_at'] = time();
        $data['admin_updated_by'] = Session::get('admin_id');

        Admin::updateByAdminId($adminId, $data);

        Session::put('msg_update_success', 'Update admin successfully!');

        return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
    }
}
