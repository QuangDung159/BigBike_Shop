<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Constant;
use App\Order;
use App\Product;
use App\ShippingStatus;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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

    public function showDetailPage($orderId)
    {
        if (!$orderId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $orderInfo = Order::getByIdIsNotDeleted($orderId);
        if (!$orderInfo) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $listUser = User::getAll()->get();
        $listUser = HelperController::convertStdToArray($listUser);
        $arrAssocUser = array_column($listUser, 'user_email', 'user_id');

        $listShippingStatus = ShippingStatus::getAll()->get();
        $listShippingStatus = HelperController::convertStdToArray($listShippingStatus);
        $arrAssocShippingStatus = array_column($listShippingStatus, 'shipping_status_name', 'shipping_status_id');

        $listProductByOrderId = Product::getListProductByOrderId($orderId);
        $total = 0;
        foreach ($listProductByOrderId as $key => $productItem) {
            $total += $productItem->product_promotion_price * $productItem->order_product_qty;
        }

        return View(Constant::PATH_ADMIN_ORDER_DETAIL)
            ->with('order', $orderInfo)
            ->with('assocUser', $arrAssocUser)
            ->with('assocShippingStatus', $arrAssocShippingStatus)
            ->with('listProductOrder', $listProductByOrderId)
            ->with('total', $total);
    }
}
