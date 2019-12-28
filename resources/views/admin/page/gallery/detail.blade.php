@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_update_success') != null) {
                /** @var TYPE_NAME $gallery */
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/gallery/update') . '/' . $gallery->gallery_id . '"> Continue edit </a>' . ' or <a href="' . URL::to('/admin/gallery/read') . '"> back to listing.</a>' . '</strong>
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
                                {{$gallery->gallery_name}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Gallery Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="gallery_name"
                                                   id="f-name" value="{{$gallery->gallery_name}}"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Product Name</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   name="gallery_description"
                                                   id="l-name" disabled
                                                   class="form-control" value="{{$gallery->product_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Gallery Images</label>
                                        @foreach($listImage as $key => $imageItem)
                                            <img width="100" alt=""
                                                 src="{{asset('/client/img/product/product')}}/{{$imageItem->image_path}}">
                                        @endforeach
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
