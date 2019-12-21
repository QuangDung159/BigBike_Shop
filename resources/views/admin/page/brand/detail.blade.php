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
                                {{$brand->brand_name}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" action="" method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Brand Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="brand_name"
                                                   id="f-name" value="{{$brand->brand_name}}"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Brand Description</label>
                                        <div class="col-lg-6">
                                            <input type="text" value="{{$brand->brand_desc}}"
                                                   name="brand_description"
                                                   id="l-name" disabled
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Brand logo</label>
                                        <img width="100" alt="" src="{{asset('/upload/logo')}}/{{$brand->brand_logo}}">
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
