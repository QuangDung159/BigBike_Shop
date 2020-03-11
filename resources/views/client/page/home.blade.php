@extends('client.layout.master')
@section('content')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#337AB7; color:white;">
                <h2 style="margin-top:0px; margin-bottom:0px;">Motorbike News</h2>
            </div>

            <div class="panel-body">
                <!-- item -->
                @foreach($listBrandCategory as $key => $brandCategory)
                    <div class="row-item row">
                        <h3>
                            <a href="category.html">{{$key}}</a> |
                            @foreach($brandCategory as $index => $category)
                                <small><a href="category.html"><i>{{$category[0]}}</i></a>/</small>
                            @endforeach
                        </h3>
                        <div class="col-md-8 border-right">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="{{asset('/client/image//320x150.png')}}" alt="">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <h3>Project Five</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, quo, minima,
                                    inventore voluptatum saepe quos nostrum provident .</p>
                                <a class="btn btn-primary" href="detail.html">View Project <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>

                        </div>


                        <div class="col-md-4">
                            <a href="detail.html">
                                <h4>
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </h4>
                            </a>

                            <a href="detail.html">
                                <h4>
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </h4>
                            </a>

                            <a href="detail.html">
                                <h4>
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </h4>
                            </a>

                            <a href="detail.html">
                                <h4>
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </h4>
                            </a>
                        </div>

                        <div class="break"></div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
