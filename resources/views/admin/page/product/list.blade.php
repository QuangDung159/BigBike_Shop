@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_add_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_add_success') .
                    '<a href="' . URL::to('/admin/product/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_add_success', null);
            }
            ?>

            <?php
            if (Session::get('msg_create_gallery_to_active') != null) {
                echo '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_create_gallery_to_active') .
                    '<a href="' . URL::to('/admin/gallery/create?product_id=') . Session::get('product_id_to_add_gallery') . '"> Add gallery.</a>' . '</strong>
                      </div>';
                Session::put('msg_create_gallery_to_active', null);
                Session::put('product_id_to_add_gallery', null);
            }
            ?>

            <?php
            if (Session::get('msg_delete_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_delete_success') .
                    '<a href="' . URL::to('/admin/product/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_delete_success', null);
            }
            ?>

            <?php
            if (Session::get('msg_update_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/product/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_update_success', null);
            }
            ?>

            <?php
            if (Session::get('msg_order_contain') != null) {
                echo '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_order_contain') . '</strong>
                      </div>';
                Session::put('msg_order_contain', null);
            }
            ?>

            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Product
                    </div>
                    <div class="row w3-res-tb">
                        {{--                        <div class="col-sm-5 m-b-xs">--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-sm-4">--}}
                        {{--                        </div>--}}
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="input-sm form-control" placeholder="Search">
                                <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listProduct as $key => $productItem)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/product/read/detail')}}/{{$productItem->product_id}}">{{$productItem->product_name }}</a>
                                    </td>
                                    <td>
                                        @if($productItem->product_status == 0)
                                            <a href="{{URL::to('/admin/product/update/change-status')}}/{{$productItem->product_id}}/{{$productItem->product_status}}"><span
                                                    class="label label-default">Inactive</span></a>
                                        @else
                                            <a href="{{URL::to('/admin/product/update/change-status')}}/{{$productItem->product_id}}/{{$productItem->product_status}}"><span
                                                    class="label label-success">Active</span></a>
                                        @endif
                                    </td>
                                    <td><span class="text-ellipsis">
                                            {{$productItem->product_price}}
                                        </span>
                                    </td>
                                    <td><span class="text-ellipsis">
                                            {{$productItem->product_stock}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{date('Y/m/d H:i:s', $productItem->product_created_at)}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$assocAdmin[$productItem->product_created_by]}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            @if(!$productItem->product_updated_by)
                                                N/A
                                            @else
                                                {{date('Y/m/d H:i:s', $productItem->product_updated_at)}}
                                            @endif
                                        </span>
                                    </td>
                                    <td><span class="text-ellipsis">
                                            @if(!$productItem->product_updated_by)
                                                N/A
                                            @else
                                                {{$assocAdmin[$productItem->product_updated_by]}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/product/update')}}/{{$productItem->product_id}}"
                                           class="active" ui-toggle-class="">
                                            <i class="fa fa-edit text-success text-active"></i>
                                        </a>
                                        <a href="{{URL::to('/admin/product/delete')}}/{{$productItem->product_id}}"
                                           onclick="return confirm('Are you want to delete this?')">
                                            <i class="fa fa-trash text-danger text"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-5 text-center">
                                <small class="text-muted inline m-t-sm m-b-sm">Showing {{$listProduct->firstItem()}}
                                    - {{$listProduct->lastItem()}} of {{$listProduct->total()}} items</small>
                            </div>
                            <div class="col-sm-7 text-right text-center-xs">
                                {!!$listProduct->links()!!}
                            </div>
                        </div>
                    </footer>
                </div>
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
