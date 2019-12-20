@extends('client.layout.master')
@section('content')
    <script src="{{asset('/client/js/home.js')}}"></script>
    <!--================Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="overlay"></div>
        <div class="banner_inner d-flex align-items-center">
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <!--================Hot Deals Area =================-->
    <section class="hot_deals_area section_gap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hot_deal_box">
                        <img class="img-fluid" src="{{asset('/client/img/product/hot_deals/deal1.jpg')}}" alt="">
                        <div class="content">
                            <h2>Hot Deals of this Month</h2>
                            <p>shop now</p>
                        </div>
                        <a class="hot_deal_link" href="#"></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hot_deal_box">
                        <img class="img-fluid" src="{{asset('/client/img/product/hot_deals/deal1.jpg')}}" alt="">
                        <div class="content">
                            <h2>Hot Deals of this Month</h2>
                            <p>shop now</p>
                        </div>
                        <a class="hot_deal_link" href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Hot Deals Area =================-->
    <!--================Clients Logo Area =================-->
    <section class="clients_logo_area">
        <div class="container-fluid">
            <div class="clients_slider owl-carousel">
                <div class="item">
                    <img src="{{asset('/client/img/clients-logo/c-logo-1.png')}}" alt="">
                </div>
                <div class="item">
                    <img src="{{asset('/client/img/clients-logo/c-logo-2.png')}}" alt="">
                </div>
                <div class="item">
                    <img src="{{asset('/client/img/clients-logo/c-logo-3.png')}}" alt="">
                </div>
                <div class="item">
                    <img src="{{asset('/client/img/clients-logo/c-logo-4.png')}}" alt="">
                </div>
                <div class="item">
                    <img src="{{asset('/client/img/clients-logo/c-logo-5.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--================End Clients Logo Area =================-->

    <!--================Feature Product Area =================-->
    <section class="feature_product_area section_gap">
        <div class="main_box">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_title">
                        <h2>Featured Products</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach($listFeatureProduct as $key => $product)
                        <div class="col col1">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid"
                                         src="{{asset('/client/img/product/product')}}/{{$product->product_thumbnail}}"
                                         alt="" width="330" height="160">
                                    <div class="p_icon">
{{--                                        <a href="javascript:{}"--}}
{{--                                           onclick="submitAddToCartHomePage('{{$product->product_id}}')">--}}
{{--                                            <form action="{{URL::to('/cart/doAddToCart')}}" method="post"--}}
{{--                                                  id="add_to_cart_form_{{$product->product_id}}">--}}
{{--                                                {{csrf_field()}}--}}
{{--                                                <input type="hidden" name="qty" value="1">--}}
{{--                                                <input type="hidden" name="current_url" value="/">--}}
{{--                                                <input type="hidden" name="product_id" value="{{$product->product_id}}">--}}
{{--                                            </form>--}}
{{--                                            <i class="lnr lnr-cart"></i>--}}
{{--                                        </a>--}}
                                        <a href="{{URL::to('/cart/doAddToCartGet')}}/{{$product->product_id}}">
                                            <i class="lnr lnr-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="{{URL::to('/product')}}/{{$product->product_id}}">
                                    <h4>{{$product->product_name}}</h4>
                                </a>
                                <h5>${{$product->product_price}}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--================End Feature Product Area =================-->
    <?php
    if (Session::has('msg_add_to_cart_success')) {
        echo '
        <input type="hidden" id="btn_trigger_modal" class="btn btn-info btn-lg" data-toggle="modal"
           data-target="#myModal">

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <h2>' . Session::get('msg_add_to_cart_success') . '</h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        ';

        Session::forget('msg_add_to_cart_success');
    }
    ?>
@endsection
