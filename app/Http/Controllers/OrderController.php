<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Constant;
use App\Order;
use App\ShippingStatus;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    /**
     * @param Request $req
     * @return JsonResponse
     */
    public function doUpdateShippingStatus(Request $req)
    {
        $shippingStatusId = $req->shipping_status_id;
        $orderId = $req->order_id;

        $data = [];
        $data['shipping_status_id'] = $shippingStatusId;
        $data['order_updated_at'] = time();
        $data['order_updated_by'] = Session::get('admin_id');

        Order::updateById($orderId, $data);

        Session::put('msg_update_success', 'Update order successfully!');
        return response()->json(
            [
                'url' => Constant::URL_ADMIN_ORDER . '/read',
            ], 200
        );
    }
}
