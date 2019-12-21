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
                                Basic validations
                                <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                            </header>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal ">
                                    <div class="form-group has-success">
                                        <label class="col-lg-3 control-label">sample 1</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="" id="f-name" class="form-control">
                                            <p class="help-block">Successfully done</p>
                                        </div>
                                    </div>
                                    <div class="form-group has-error">
                                        <label class="col-lg-3 control-label">sample 2</label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="" id="l-name" class="form-control">
                                            <p class="help-block">You gave a wrong info</p>
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label class="col-lg-3 control-label">sample 3</label>
                                        <div class="col-lg-6">
                                            <input type="email" placeholder="" id="email2" class="form-control">
                                            <p class="help-block">Something went wrong</p>
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
