@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_update_success') != null) {
                /** @var TYPE_NAME $brand */
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/brand/update') . '/' . $brand->brand_id . '"> Continue edit </a>' . ' or <a href="' . URL::to('/admin/brand/read') . '"> back to listing.</a>' . '</strong>
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
                                Order #{{$order->order_id}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="order_id" class="col-lg-3 control-label">Order ID</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="order_id"
                                                   value="Order #{{$order->order_id}}"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_email" class="col-lg-3 control-label">User Email</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="user_email"
                                                   value="{{$assocUser[$order->user_id]}}"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="shipping_status_id" class="col-lg-3 control-label">Shipping
                                            Status</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="shipping_status_id"
                                                   value="{{$assocShippingStatus[$order->shipping_status_id]}}"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total" class="col-lg-3 control-label">Total</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="total"
                                                   value="${{$total}}"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>

                        {{--order detail--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">Order Detail</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Thumbnail</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($listProductOrder as $key => $productItem)
                                            <tr>
                                                <td>
                                                    <span class="text-ellipsis">
                                                        {{$productItem->product_name}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <img width="100" alt=""
                                                         src="{{asset('/client/img/product/product')}}/{{$productItem->product_thumbnail}}">
                                                </td>
                                                <td>
                                                    <span class="text-ellipsis">
                                                        {{$productItem->product_promotion_price}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-ellipsis">
                                                        {{$productItem->order_product_qty}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
