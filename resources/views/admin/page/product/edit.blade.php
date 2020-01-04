@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="form-w3layouts">
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Edit Product {{$product->product_name}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" action="{{URL::to('/admin/product/update')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                    <div class="form-group">
                                        <label for="product_name" class="col-lg-3 control-label">Product Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Enter product name" name="product_name"
                                                   id="product_name"
                                                   class="form-control" value="{{$product->product_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="brand_id">
                                            Brand Name
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control m-bot15" name="brand_id" id="brand_id">
                                                @foreach($listBrand as $key => $brandItem)
                                                    @if($brandItem->brand_id == $brandCategory->brand_id)
                                                        <option
                                                            value="{{$brandItem->brand_id}}"
                                                            selected>{{$brandItem->brand_name}}</option>
                                                    @else
                                                        <option
                                                            value="{{$brandItem->brand_id}}">{{$brandItem->brand_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="category_id">
                                            Category Name
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control m-bot15" name="category_id"
                                                    id="category_id">
                                                @foreach($listCategory as $key => $categoryItem)
                                                    @if($categoryItem->category_id == $brandCategory->category_id)
                                                        <option
                                                            value="{{$categoryItem->category_id}}"
                                                            selected>{{$categoryItem->category_name}}</option>
                                                    @else
                                                        <option
                                                            value="{{$categoryItem->category_id}}">{{$categoryItem->category_name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_desc" class="col-lg-3 control-label">Product
                                            Description</label>
                                        <div class="col-lg-6">
                                            <textarea type="text" placeholder="Enter product description"
                                                      name="product_desc"
                                                      id="product_desc"
                                                      class="form-control">{{$product->product_desc}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_content" class="col-lg-3 control-label">Product
                                            Content</label>
                                        <div class="col-lg-6">
                                            <textarea type="text" placeholder="Enter product content"
                                                      name="product_content"
                                                      id="product_content"
                                                      class="form-control">{{$product->product_content}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_price" class="col-lg-3 control-label">Product
                                            Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product price"
                                                   name="product_price"
                                                   id="product_price"
                                                   class="form-control" value="{{$product->product_price}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_promotion_price" class="col-lg-3 control-label">Product
                                            Promotion Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product promotion price"
                                                   name="product_promotion_price"
                                                   id="product_promotion_price"
                                                   class="form-control" value="{{$product->product_promotion_price}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_stock" class="col-lg-3 control-label">Product
                                            Stock</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product stock"
                                                   name="product_stock"
                                                   id="product_stock"
                                                   class="form-control" value="{{$product->product_stock}}">
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
                                        <label for="product_thumbnail" class="col-lg-3 control-label"></label>
                                        <div class="col-lg-6">
                                            <input type="file" id="product_thumbnail" name="product_thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"></label>
                                        <div class="col-lg-6">
                                            @if($errors->any())
                                                <div class="alert alert-danger" style="margin-top: 10px">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    @foreach($errors->all() as $errorItem)
                                                        <p>{{$errorItem}}</p>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <?php
                                            if (Session::has('msg_name_existed')) {
                                                echo
                                                    '<div class="alert alert-danger" style="margin-top: 10px">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <p>' . Session::get('msg_name_existed') . '</p>
                                                </div>';
                                                Session::forget('msg_name_existed');
                                            }
                                            ?>
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

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"></label>
                                        <div class="col-lg-6">
                                            <a href="{{URL::to('/admin/gallery/update')}}/{{$gallery->gallery_id}}">Update
                                                Gallery</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Submit</button>
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
