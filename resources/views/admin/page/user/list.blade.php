@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_delete_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_delete_success') .
                    '<a href="' . URL::to('/admin/user/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_delete_success', null);
            }
            ?>

            <?php
            if (Session::get('msg_update_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/user/create') . '"> Add more.</a>' . '</strong>
                      </div>';
                Session::put('msg_update_success', null);
            }
            ?>

            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listUser as $key => $userItem)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>
                                       <span class="text-ellipsis">
                                            {{$userItem->user_name}}
                                        </span>
                                    </td>
                                    <td>
                                       <span class="text-ellipsis">
                                            {{$userItem->user_email}}
                                        </span>
                                    </td>
                                    <td>
                                       <span class="text-ellipsis">
                                            {{$userItem->user_phone}}
                                        </span>
                                    </td>
                                    <td>
                                       <span class="text-ellipsis">
                                            {{$userItem->user_address}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{date('Y/m/d H:i:s', $userItem->user_created_at)}}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-5 text-center">
                                <small class="text-muted inline m-t-sm m-b-sm">Showing {{$listUser->firstItem()}}
                                    - {{$listUser->lastItem()}} of {{$listUser->total()}} items</small>
                            </div>
                            <div class="col-sm-7 text-right text-center-xs">
                                {!!$listUser->links()!!}
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
