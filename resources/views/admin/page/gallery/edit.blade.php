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
                                Edit {{$brandCategory->brand_name}} - {{$brandCategory->category_name}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal"
                                      action="{{URL::to('/admin/brand_category/update')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$brandCategory->brand_category_id}}"
                                           name="brand_category_id">
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
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"></label>
                                        <div class="col-lg-6">

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
@endsection
