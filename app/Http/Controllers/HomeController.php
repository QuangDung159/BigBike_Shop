<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Constant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function showHomePage()
    {
        return view(Constant::PATH_HOME);
    }

    public function showAdminDashboard()
    {
        return view(Constant::PATH_ADMIN_DASHBOARD);
    }
}
