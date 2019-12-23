<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showAdminLoginPage()
    {
        return view(Constant::PATH_ADMIN_ADMIN_LOGIN);
    }

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
}
