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
                                Create New Gallery
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal bucket-form"
                                      action="{{URL::to('/admin/gallery/create')}}"
                                      method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Gallery Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Enter gallery name" name="gallery_name"
                                                   id="f-name"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-lg-3" for="product_id">
                                            Product Name
                                        </label>
                                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right"
                                           title="List product without gallery"></i>
                                        <div class="col-lg-6">
                                            <select class="form-control m-bot15" name="product_id"
                                                    id="product_id">
                                                @foreach($listProduct as $key => $productItem)
                                                    <option
                                                        value="{{$productItem->product_id}}">{{$productItem->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Image 1</label>
                                        <div class="col-lg-6">
                                            <input type="file" name="image_path_1">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Image 2</label>
                                        <div class="col-lg-6">
                                            <input type="file" name="image_path_2">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Image 3</label>
                                        <div class="col-lg-6">
                                            <input type="file" name="image_path_3">
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
                                            if (Session::has('msg_exist')) {
                                                echo
                                                    '<div class="alert alert-danger" style="margin-top: 10px">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <p>' . Session::get('msg_exist') . '</p>
                                                </div>';
                                                Session::forget('msg_exist');
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
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
