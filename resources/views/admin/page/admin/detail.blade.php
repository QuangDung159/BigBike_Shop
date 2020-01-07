@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (Session::get('msg_update_success') != null) {
                /** @var TYPE_NAME $admin */
                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>' . Session::get('msg_update_success') .
                    '<a href="' . URL::to('/admin/admin/update') . '/' . $admin->admin_id . '"> Continue edit </a>' . ' or <a href="' . URL::to('/admin/admin/read') . '"> back to listing.</a>' . '</strong>
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
                                {{$admin->admin_name}}
                                <span class="tools pull-right">
{{--                                <a class="fa fa-chevron-down" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-cog" href="javascript:;"></a>--}}
                                    {{--                                <a class="fa fa-times" href="javascript:;"></a>--}}
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="admin_name" class="col-lg-3 control-label">Admin Name</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   id="admin_name"
                                                   class="form-control" value="{{$admin->admin_name}}"
                                                   disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_email" class="col-lg-3 control-label">Admin
                                            Email</label>
                                        <div class="col-lg-6">
                                            <input type="email"
                                                   id="admin_email"
                                                   class="form-control" value="{{$admin->admin_email}}"
                                                   disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>

                        <div class="panel panel-default">
                            <div class="panel-heading">Access Control List</div>
                            <div class="panel-body">
                                @foreach($listActionModule as $key => $moduleItem)
                                    <div class="form-group">
                                        <h2>{{$moduleItem->module_name}}</h2>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-10">
                                                @foreach($moduleItem->list_action as $keyAction => $actionItem)
                                                    @if($actionItem->is_active == 1)
                                                        <div class="col-lg-3">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" data-toggle="toggle"
                                                                       data-on="Enabled"
                                                                       data-off="Disabled" checked disabled
                                                                       id="{{$actionItem->action_id}}-{{$moduleItem->module_id}}">
                                                                {{$actionItem->action_name}}
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-3">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" data-toggle="toggle"
                                                                       data-on="Enabled"
                                                                       data-off="Disabled" disabled
                                                                       id="{{$actionItem->action_id}}-{{$moduleItem->module_id}}">
                                                                {{$actionItem->action_name}}
                                                            </label>
                                                        </div>
                                                    @endif
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
