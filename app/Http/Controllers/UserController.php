<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Constant;
use App\Product;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listUser = User::getAll()
            ->orderBy(Constant::TABLE_USER . '.user_created_at', 'desc')
            ->paginate(10);

        return view(Constant::PATH_ADMIN_USER_LIST)
            ->with('listUser', $listUser);
    }
}
