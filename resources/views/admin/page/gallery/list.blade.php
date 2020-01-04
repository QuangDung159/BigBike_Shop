@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_add_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_add_success') .
                    '<a href="' . URL::to('/admin/gallery/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_add_success', null);
            }
            ?>

            <?php
            if (Session::get('msg_delete_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_delete_success') .
                    '<a href="' . URL::to('/admin/gallery/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_delete_success', null);
            }
            ?>

            <?php
            if (Session::get('msg_update_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/gallery/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_update_success', null);
            }
            ?>

            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Gallery
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
                                <th>Gallery Name</th>
                                <th>Product Name</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listGallery as $key => $galleryItem)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/gallery/read/detail')}}/{{$galleryItem->gallery_id}}"><span
                                                class="text-ellipsis">
                                            {{$galleryItem->gallery_name}}
                                        </span></a>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$galleryItem->product_name}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{date('Y/m/d H:i:s', $galleryItem->gallery_created_at)}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$assocAdmin[$galleryItem->gallery_created_by]}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            @if(!$galleryItem->gallery_updated_by)
                                                N/A
                                            @else
                                                {{date('Y/m/d H:i:s', $galleryItem->gallery_updated_at)}}
                                            @endif
                                        </span>
                                    </td>
                                    <td><span class="text-ellipsis">
                                            @if(!$galleryItem->gallery_updated_by)
                                                N/A
                                            @else
                                                {{$assocAdmin[$galleryItem->gallery_updated_by]}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/gallery/update')}}/{{$galleryItem->gallery_id}}"
                                           class="active" ui-toggle-class="">
                                            <i class="fa fa-edit text-success text-active"></i>
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
                                <small
                                    class="text-muted inline m-t-sm m-b-sm">Showing {{$listGallery->firstItem()}}
                                    - {{$listGallery->lastItem()}} of {{$listGallery->total()}}
                                    items</small>
                            </div>
                            <div class="col-sm-7 text-right text-center-xs">
                                {!!$listGallery->links()!!}
                            </div>
                        </div>
                    </footer>
                </div>
            </div>

            <?php
            if (Session::get('product_id_after_create_gallery') != null) {
                echo '<input type="hidden" class="btn btn-info btn-lg" id="btn_trigger_modal_list_gallery" data-toggle="modal"
                   data-target="#myModal">
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Create gallery with product successfully!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to active this product?</p>
                            </div>
                            <a id="update_status_trigger" href="' . URL::to('/admin/product/update/change-status') . '/' . Session::get('product_id_after_create_gallery') . '/0">
                            </a>

                            <div class="modal-footer">
                                <button type="button" onclick="doClickActive()" class="btn btn-info">Active product</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>

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
