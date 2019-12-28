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
                                Edit {{$gallery->gallery_name}}
                                <span class="tools pull-right">
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal"
                                      action="{{URL::to('/admin/gallery/update')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$gallery->gallery_id}}" name="gallery_id">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Gallery Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="gallery_name"
                                                   id="f-name" value="{{$gallery->gallery_name}}"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="product_id">
                                            Product Name
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control m-bot15" name="product_id"
                                                    id="product_id">
                                                <option
                                                    value="{{$gallery->product_id}}"
                                                    selected>{{$gallery->product_name}}</option>
                                                @foreach($listProduct as $key => $productItem)
                                                    <option
                                                        value="{{$productItem->product_id}}">{{$productItem->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @foreach($listImage as $key => $imageItem)
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Image {{$key + 1}}</label>
                                            <input type="hidden" value="{{$imageItem->image_id}}"
                                                   name="image_id_{{$key + 1}}">
                                            <img width="100" alt=""
                                                 src="{{asset('/client/img/product/product')}}/{{$imageItem->image_path}}">
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"></label>
                                            <div class="col-lg-6">
                                                <input type="file" name="image_path_{{$key + 1}}">
                                            </div>
                                        </div>
                                    @endforeach

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
