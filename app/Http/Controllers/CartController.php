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

        Cart::add($data);

        Session::put('msg_add_to_cart_success', 'Add product to cart successfully.');

        return Redirect::to($currentUrl);
    }
}
