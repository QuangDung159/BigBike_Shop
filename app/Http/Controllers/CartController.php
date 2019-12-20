<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCartPage()
    {
        return view(Constant::PATH_CART);
    }

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


        echo '<pre>';
        //print_r($data);die;
        Cart::add($data);

        //Cart::destroy();

        print_r(Cart::content());
        die;
        echo '</pre>';


        return Redirect::to($currentUrl);
    }

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
}
