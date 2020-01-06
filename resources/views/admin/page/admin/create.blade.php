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
                                Create New Product
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" action="{{URL::to('/admin/product/create')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="product_name" class="col-lg-3 control-label">Product Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Enter product name" name="product_name"
                                                   id="product_name"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="brand_id">
                                            Brand Name
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control m-bot15" name="brand_id" id="brand_id">
                                                @foreach($listBrand as $key => $brandItem)
                                                    <option
                                                        value="{{$brandItem->brand_id}}">{{$brandItem->brand_name}}</option>
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
                                                    <option
                                                        value="{{$categoryItem->category_id}}">{{$categoryItem->category_name}}</option>
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
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_content" class="col-lg-3 control-label">Product
                                            Content</label>
                                        <div class="col-lg-6">
                                            <textarea type="text" placeholder="Enter product content"
                                                      name="product_content"
                                                      id="product_content"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_price" class="col-lg-3 control-label">Product
                                            Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product price"
                                                   name="product_price"
                                                   id="product_price"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_promotion_price" class="col-lg-3 control-label">Product
                                            Promotion Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product promotion price"
                                                   name="product_promotion_price"
                                                   id="product_promotion_price"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_stock" class="col-lg-3 control-label">Product
                                            Stock</label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter product stock"
                                                   name="product_stock"
                                                   id="product_stock"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_thumbnail" class="col-lg-3 control-label">Product
                                            Thumbnail</label>
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
