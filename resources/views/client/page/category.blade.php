@extends('client.layout.master')
@section('content')
    <script src="{{asset('/client/js/category.js')}}"></script>
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>{{$category->category_name}}</h2>
                    <div class="page_link">
                        <a href="{{URL::to('/')}}">Home</a>
                        <a href="{{URL::to('/category')}}/{{$category->category_id}}/0">{{$category->category_name}}</a>
                        @if($brand)
                            <a href="{{URL::to('/category')}}/{{$category->category_id}}/{{$brand->brand_id}}">{{$brand->brand_name}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
        <div class="container-fluid">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="product_top_bar">
                        @if(!$brand)
                            <div class="left_dorp">
                                <select class="sorting" id="sort_type"
                                        onchange="doSortProductByCategory('{{$category->category_id}}', '0')">
                                    @foreach($listSort as $key => $sort)
                                        @if($sortType == $sort)
                                            <option selected value="{{$sort}}">{{$key}}</option>
                                        @else
                                            <option value="{{$sort}}">{{$key}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <select class="show" id="item_per_page"
                                        onchange="doSortProductByCategory('{{$category->category_id}}', '0')">
                                    @foreach($listPerPage as $key => $perPage)
                                        @if($itemPerPage == $perPage)
                                            <option selected value="{{$perPage}}">{{$key}}</option>
                                        @else
                                            <option value="{{$perPage}}">{{$key}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="left_dorp">
                                <select class="sorting" id="sort_type"
                                        onchange="doSortProductByCategory('{{$category->category_id}}', '{{$brand->brand_id}}')">
                                    <option value="1">Rate : High to low</option>
                                    <option value="2">Rate : Low to high</option>
                                    <option value="3">Price : High to low</option>
                                    <option value="4">Price : Low to high</option>
                                </select>
                                <select class="show" id="item_per_page"
                                        onchange="doSortProductByCategory('{{$category->category_id}}', '{{$brand->brand_id}}')">
                                    <option value="12">Show 12</option>
                                    <option value="14">Show 14</option>
                                    <option value="16">Show 16</option>
                                </select>
                            </div>
                        @endif
                    </div>
                    <div class="latest_product_inner row">
                        @foreach($listProduct as $key => $product)
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid"
                                             src="{{asset('/client/img/product/product')}}/{{$product->product_thumbnail}}"
                                             alt="">
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
                    <hr>
                    <div class="row">
                        <nav class="mx-auto" aria-label="Page navigation example">
                            {{$listProduct->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach($listCategory as $key => $categoryItem)
                                        <li>
                                            <a href="{{URL::to('/category')}}/{{$categoryItem->category_id}}/0">{{$categoryItem->category_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Product Filters</h3>
                            </div>
                            <div class="widgets_inner">
                                <h4>Brand</h4>
                                <ul class="list">
                                    @if(!$brand)
                                        @foreach($listBrand as $key => $brandItem)
                                            <li class="">
                                                <a href="{{URL::to('/category')}}/{{$category->category_id}}/{{$brandItem->brand_id}}">{{$brandItem->brand_name}}</a>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach($listBrand as $key => $brandItem)
                                            @if($brand->brand_id == $brandItem->brand_id)
                                                <li class="active">
                                                    <a href="{{URL::to('/category')}}/{{$category->category_id}}/{{$brandItem->brand_id}}">{{$brandItem->brand_name}}</a>
                                                </li>
                                            @else
                                                <li class="">
                                                    <a href="{{URL::to('/category')}}/{{$category->category_id}}/{{$brandItem->brand_id}}">{{$brandItem->brand_name}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection
