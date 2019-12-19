@extends('client.layout.master')
@section('content')
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
                                         src="{{asset('/client/img/product/product')}}/{{$product->image_path}}"
                                         alt="" width="330" height="160">
                                    <div class="p_icon">
                                        <a href="#">
                                            <i class="lnr lnr-heart"></i>
                                        </a>
                                        <a href="#">
                                            <i class="lnr lnr-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="#">
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
@endsection
