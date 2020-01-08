@extends('client.layout.master')
@section('content')
    <script src="{{asset('/client/js/product_detail.js')}}"></script>
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>{{$product->brand_name}} {{$product->product_name}}</h2>
                    <div class="page_link">
                        <a href="{{URL::to('/')}}">Home</a>
                        <a href="{{URL::to('/category')}}/{{$product->category_id}}/{{$product->brand_id}}">{{$product->category_name}}</a>
                        <a href="#">{{$product->brand_name}} {{$product->product_name}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_product_img">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($listImage as $key => $image)
                                    @if ($key == 0)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active">
                                            <img src="{{asset('/client/img/product/product')}}/{{$image->image_path}}"
                                                 alt="" width="70">
                                        </li>
                                    @else
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1">
                                            <img src="{{asset('/client/img/product/product')}}/{{$image->image_path}}"
                                                 alt="" width="70">
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($listImage as $key => $image)
                                    @if ($key == 0)
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                 src="{{asset("client/img/product/product")}}/{{$image->image_path}}"
                                                 alt="First slide">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                 src="{{asset("client/img/product/product")}}/{{$image->image_path}}"
                                                 alt="First slide">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{$product->brand_name}} {{$product->product_name}}</h3>
                        <h2>${{$product->product_price}}</h2>
                        <ul class="list">
                            <li>
                                <a class="active" href="{{URL::to('/category')}}/{{$product->category_id}}/0">
                                    <span>Category</span> : {{$product->category_name}}
                                </a>
                            </li>
                            <li>
                                <a class="active" href="#">
                                    <span>Brand</span> : {{$product->brand_name}}
                                </a>
                            </li>
                            <li>
                                @if ($product->product_stock == 0)
                                    <a><span>Availibility</span> : Out of stock</a>
                                @else
                                    <a><span>Availibility</span> : In Stock</a>
                                @endif
                            </li>
                        </ul>
                        <p>{{$product->product_desc}}</p>
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                   class="input-text qty">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button">
                                <i class="lnr lnr-chevron-up"></i>
                            </button>
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button">
                                <i class="lnr lnr-chevron-down"></i>
                            </button>
                        </div>
                        <div class="card_area">
                            <a class="main_btn"
                               href="{{URL::to('/cart/doAddToCartProductDetail')}}/{{$product->product_id}}">Add to
                                Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                       aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                       aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{{$product->product_desc}}</p>
                </div>
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="review_list">
                                @foreach($listReview as $key => $review)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4>{{$review->user_name}}</h4>
                                            </div>
                                        </div>
                                        <p>{{$review->content}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <form class="row contact_form" action="contact_process.php" method="post"
                                      id="contactForm" novalidate="novalidate">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Your Full name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="number" name="number"
                                                   placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="1"
                                                      placeholder="Review"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="btn submit_btn">Submit Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
