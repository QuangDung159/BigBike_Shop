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
                                Create New Admin
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" action="{{URL::to('/admin/admin/create')}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="admin_name" class="col-lg-3 control-label">Admin Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Enter admin name" name="admin_name"
                                                   id="admin_name"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_email" class="col-lg-3 control-label">Admin
                                            Email</label>
                                        <div class="col-lg-6">
                                            <input type="email" placeholder="Enter admin email"
                                                   name="admin_email"
                                                   id="admin_email"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_password" class="col-lg-3 control-label">Admin
                                            Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" placeholder="Enter admin password"
                                                   name="admin_password"
                                                   id="admin_password"
                                                   class="form-control">
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
                                            if (Session::has('msg_name_existed')) {
                                                echo
                                                    '<div class="alert alert-danger" style="margin-top: 10px">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <p>' . Session::get('msg_name_existed') . '</p>
                                                </div>';
                                                Session::forget('msg_name_existed');
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

                        <div class="panel panel-default">
                            <div class="panel-heading">Access Control List</div>
                            <div class="panel-body">
                                @foreach($listModule as $key => $moduleItem)
                                    <div class="form-group">
                                        <h2>{{$moduleItem->module_name}}</h2>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-10">
                                                @foreach($moduleItem->list_action as $keyAction => $actionItem)
                                                    <div class="col-lg-3">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" checked data-toggle="toggle"
                                                                   data-on="Enabled"
                                                                   data-off="Disabled">{{$actionItem->action_name}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-lg-1"></div>
                                        </div>
                                        <hr/>
                                    </div>
                                @endforeach
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
