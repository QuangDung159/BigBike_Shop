@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_delete_success') != null) {
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_delete_success') . '</strong>
                      </div>';
                Session::put('msg_delete_success', null);
            }
            ?>

            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Review
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

                                <th>Product Name</th>
                                <th>User Email</th>
                                <th>Content</th>
                                <th>Created At</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listReview as $key => $reviewItem)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$reviewItem->product_name}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$reviewItem->user_email}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$reviewItem->review_content}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{date('Y/m/d H:i:s', $reviewItem->review_created_at)}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/admin/review/delete')}}/{{$reviewItem->review_id}}"
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
                                <small class="text-muted inline m-t-sm m-b-sm">Showing {{$listReview->firstItem()}}
                                    - {{$listReview->lastItem()}} of {{$listReview->total()}} items</small>
                            </div>
                            <div class="col-sm-7 text-right text-center-xs">
                                {!!$listReview->links()!!}
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
