<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Order;
use App\OrderProduct;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showCartPage()
    {
        $listProductInCart = Cart::content();
        $total = Cart::subtotal();
        return view(Constant::PATH_CART)
            ->with('listProductInCart', $listProductInCart)
            ->with('total', $total);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     */
    public function doAddToCart(Request $req)
    {
        $productId = $req->product_id;
        $qty = $req->qty;
        $currentUrl = $req->current_url;

        $product = Product::getByIdClient($productId);

        if (!$product) {
            return Redirect::to(Constant::PATH_HOME);
        }

        $data = [
            'id' => $productId,
            'name' => $product->product_name,
            'qty' => $qty,
            'price' => $product->product_price,
            'weight' => 0,
            'options' => [
                'product_thumbnail' => $product->product_thumbnail
            ]
        ];

        Session::put('msg_add_to_cart_success', 'Add product to cart successfully.');
        return Redirect::to($currentUrl);
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function doAddToCartGet($productId)
    {
        $product = Product::getByIdClient($productId);

        if (!$product) {
            return Redirect::to(Constant::PATH_HOME);
        }

        $data = [
            'id' => $productId,
            'name' => 'asd',
            'qty' => 1,
            'price' => 123123,
            'weight' => 0,
            'options' => [
                'product_thumbnail' => $product->product_thumbnail
            ]
        ];

        Cart::add($data);

        Session::put('msg_add_to_cart_success', 'Add product to cart successfully.');

        return Redirect::to('/');
    }

    /**
     * @param int $productId
     * @return RedirectResponse
     */
    public function doAddToCartProductDetail($productId)
    {
        $product = Product::getByIdClient($productId);

        if (!$product) {
            return Redirect::to(Constant::PATH_HOME);
        }

        $data = [
            'id' => $productId,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->product_price,
            'weight' => 0,
            'options' => [
                'product_thumbnail' => $product->product_thumbnail
            ]
        ];

        Cart::add($data);

        Session::put('msg_add_to_cart_success', 'Add product to cart successfully.');
        return Redirect::to(Constant::URL_PRODUCT_DETAIL . $productId);
    }

    public function doSubmitOrder()
    {
        $orderData = [];
        $orderData['shipping_status_id'] = 1;
        $orderData['user_id'] = 1;
        $orderData['order_created_at'] = time();

        $orderId = Order::insertOrderGetId($orderData);
        $listProductInCart = Cart::content();
        foreach ($listProductInCart as $key => $productItem) {
            $data = [];
            $data['order_id'] = $orderId;
            $data['product_id'] = $productItem->id;
            $data['order_product_qty'] = $productItem->qty;

            OrderProduct::insert($data);
        }

        Session::put('msg_submit_order_success', 'Your order was submitted successfully. Thanks for shopping.');
        return Redirect::to(Constant::URL_HOME);
    }
}
