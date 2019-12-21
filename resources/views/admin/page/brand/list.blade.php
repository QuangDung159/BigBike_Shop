@extends('admin.layout.master')
@section('content')
    <section id="main-content">
        <section class="wrapper">
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
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listBrand as $key => $brandItem)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                name="post[]"><i></i></label></td>
                                    <td>{{$brandItem->brand_name }}
                                    </td>
                                    <td>
                                        @if($brandItem->brand_status == 0)
                                            <span class="label label-default">Inactive</span>
                                        @else
                                            <span class="label label-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{date('Y/m/d H:i:s', $brandItem->brand_created_at)}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{$assocAdmin[$brandItem->brand_created_by]}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            @if(!$brandItem->brand_updated_by)
                                                N/A
                                            @else
                                                {{date('Y/m/d H:i:s', $brandItem->brand_updated_at)}}
                                            @endif
                                        </span>
                                    </td>
                                    <td><span class="text-ellipsis">
                                            @if(!$brandItem->brand_updated_by)
                                                N/A
                                            @else
                                                {{$assocAdmin[$brandItem->brand_updated_by]}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="" class="active" ui-toggle-class="">
                                            <i class="fa fa-edit text-success text-active"></i>
                                        </a>
                                        <a href="{{URL::to('/admin/brand/delete')}}/{{$brandItem->brand_id}}">
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
                                <small class="text-muted inline m-t-sm m-b-sm">Showing {{$listBrand->firstItem()}}
                                    - {{$listBrand->lastItem()}} of {{$listBrand->total()}} items</small>
                            </div>
                            <div class="col-sm-7 text-right text-center-xs">
                                {{--                                <ul class="pagination pagination-sm m-t-none m-b-none">--}}
                                {{--                                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>--}}
                                {{--                                    <li><a href="">1</a></li>--}}
                                {{--                                    <li><a href="">2</a></li>--}}
                                {{--                                    <li><a href="">3</a></li>--}}
                                {{--                                    <li><a href="">4</a></li>--}}
                                {{--                                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>--}}
                                {{--                                </ul>--}}

                                {!!$listBrand->links()!!}
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
