@extends('client.layout.master')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Shopping Cart</h2>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="cart.html">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listProductInCart as $key => $productItem)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img
                                                src="{{asset(URL::to('client/img/product/product'))}}/{{$productItem->options->product_thumbnail}}"
                                                alt="" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <p>{{$productItem->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>${{$productItem->price}}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12"
                                               value="{{$productItem->qty}}"
                                               title="Quantity:"
                                               class="input-text qty" disabled>
                                    </div>
                                </td>
                                <td>
                                    <h5>${{$productItem->price * $productItem->qty}}</h5>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Total</h5>
                            </td>
                            <td>
                                <h5>${{$total}}</h5>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner">
                                    <a class="gray_btn" href="#">Continue Shopping</a>
                                    <a class="main_btn" href="{{URL::to('/cart/submitOrder')}}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
