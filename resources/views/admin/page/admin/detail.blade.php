@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_update_success') != null) {
                /** @var TYPE_NAME $product */
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/product/update') . '/' . $product->product_id . '"> Continue edit </a>' . ' or <a href="' . URL::to('/admin/product/read') . '"> back to listing.</a>' . '</strong>
                      </div>';
                Session::put('msg_update_success', null);
            }
            ?>

            <div class="form-w3layouts">
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                {{$product->product_name}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="product_name" class="col-lg-3 control-label">Product Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Enter product name" name="product_name"
                                                   id="product_name"
                                                   class="form-control" disabled value="{{$product->product_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="brand_name">
                                            Brand Name
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="brand_name"
                                                   id="brand_name"
                                                   class="form-control" disabled value="{{$brandCategory->brand_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="category_name">
                                            Category Name
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="category_name"
                                                   id="category_name"
                                                   class="form-control" disabled
                                                   value="{{$brandCategory->category_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_desc" class="col-lg-3 control-label">Product
                                            Description</label>
                                        <div class="col-lg-6">
                                            <textarea type="text" placeholder="Enter product description"
                                                      name="product_desc"
                                                      id="product_desc"
                                                      class="form-control"
                                                      disabled>{{$product->product_desc}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_content" class="col-lg-3 control-label">Product
                                            Content</label>
                                        <div class="col-lg-6">
                                            <textarea type="text" placeholder="Enter product content"
                                                      name="product_content"
                                                      id="product_content"
                                                      class="form-control"
                                                      disabled>{{$product->product_content}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_price" class="col-lg-3 control-label">Product
                                            Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product price"
                                                   name="product_price"
                                                   id="product_price"
                                                   class="form-control" disabled value="{{$product->product_price}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_promotion_price" class="col-lg-3 control-label">Product
                                            Promotion Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product promotion price"
                                                   name="product_promotion_price"
                                                   id="product_promotion_price"
                                                   class="form-control" disabled
                                                   value="{{$product->product_promotion_price}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_stock" class="col-lg-3 control-label">Product
                                            Stock</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product stock"
                                                   name="product_stock"
                                                   id="product_stock"
                                                   class="form-control" disabled value="{{$product->product_stock}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Product Thumbnail</label>
                                        <div class="col-lg-6">
                                            <img width="100" alt=""
                                                 src="{{asset('/client/img/product/product')}}/{{$product->product_thumbnail}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Product Gallery</label>
                                        <div class="col-lg-6">
                                            @foreach($listImage as $key => $imageItem)
                                                <img width="100" alt=""
                                                     src="{{asset('/client/img/product/product')}}/{{$imageItem->image_path}}">
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </div>
        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>
@endsection
