<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Constant;
use App\Order;
use App\ShippingStatus;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function showListPage()
    {
        $listOrder = Order::getAll()
            ->orderBy(Constant::TABLE_ORDER . '.order_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::getAll()->get();
        $listAdmin = HelperController::convertStdToArray($listAdmin);
        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        $listUser = User::getAll()->get();
        $listUser = HelperController::convertStdToArray($listUser);
        $arrAssocUser = array_column($listUser, 'user_email', 'user_id');

        $listShippingStatus = ShippingStatus::getAll()->get();

        return view(Constant::PATH_ADMIN_ORDER_LIST)
            ->with('listOrder', $listOrder)
            ->with('assocAdmin', $arrAssocAdmin)
            ->with('assocUser', $arrAssocUser)
            ->with('listShippingStatus', $listShippingStatus);
    }
}
