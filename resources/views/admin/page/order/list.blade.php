@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_update_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/order/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_update_success', null);
            }
            ?>

            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Brand
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
                                <th>Order ID</th>
                                <th>Shipping Status</th>
                                <th>User Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listOrder as $key => $orderItem)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/order/read/detail')}}/{{$orderItem->order_id}}">{{$orderItem->order_id}}</a>
                                    </td>
                                    <td>
                                        <select class="form-control m-bot15" name="shipping_status_id"
                                                id="shipping_status_id"
                                                onchange="doChangeShippingStatus({{$orderItem->order_id}})">
                                            @foreach($listShippingStatus as $key => $shippingStatusItem)
                                                @if($shippingStatusItem->shipping_status_id == $orderItem->shipping_status_id)
                                                    <option
                                                        value="{{$shippingStatusItem->shipping_status_id}}" selected>
                                                        {{$shippingStatusItem->shipping_status_name}}
                                                    </option>
                                                @else
                                                    <option
                                                        value="{{$shippingStatusItem->shipping_status_id}}">
                                                        {{$shippingStatusItem->shipping_status_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {{$assocUser[$orderItem->user_id]}}
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{date('Y/m/d H:i:s', $orderItem->order_created_at)}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            @if(!$orderItem->order_updated_by)
                                                N/A
                                            @else
                                                {{date('Y/m/d H:i:s', $orderItem->order_updated_at)}}
                                            @endif
                                        </span>
                                    </td>
                                    <td><span class="text-ellipsis">
                                            @if(!$orderItem->order_updated_by)
                                                N/A
                                            @else
                                                {{$assocAdmin[$orderItem->order_updated_by]}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/order/update')}}/{{$orderItem->order_id}}"
                                           class="active" ui-toggle-class="">
                                            <i class="fa fa-edit text-success text-active"></i>
                                        </a>
                                        <a href="{{URL::to('/admin/order/delete')}}/{{$orderItem->order_id}}"
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
                                <small class="text-muted inline m-t-sm m-b-sm">Showing {{$listOrder->firstItem()}}
                                    - {{$listOrder->lastItem()}} of {{$listOrder->total()}} items</small>
                            </div>
                            <div class="col-sm-7 text-right text-center-xs">
                                {!!$listOrder->links()!!}
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
