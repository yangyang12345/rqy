@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <span class="label label-primary pull-right">单位元</span>
                    <i class="fa fa-rmb"></i>
                    <h3 class="box-title">佣金账户</h3>
                </div>
                <div class="box-body">
                    <h2>5.00</h2>
                    <small>人民币</small>
                    <a href="{{ asset('/user/funds') }}" onclick="">
                        <div class="pull-right font-bold text-primary">明细 <i class="fa fa-level-up"></i></div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <span class="label label-info pull-right">单位元</span>
                    <i class="fa fa-rmb"></i>
                    <h3 class="box-title">本金账户</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <h2>5.00
                        <a href="{{ asset('/charge') }}"><span class="label label-danger pull-right" style="font-size: 16px">充值</span></a>
                    </h2>
                    <small>人民币</small>
                    <a href="{{ asset('/user/funds') }}" onclick="">
                        <div class="pull-right font-bold text-info">明细 <i class="fa fa-level-up"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="{{ asset('/user/release_task') }}">
            <div class="col-sm-2">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>
                        <p>发布任务</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cloud-upload"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ asset('/user/advance_duty') }}">
            <div class="col-sm-2">
                <div class="small-box bg-light-blue">
                    <div class="inner">
                        <h3>150</h3>
                        <p>垫付管理</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wrench"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ asset('/user/browse_task') }}">
            <div class="col-sm-2">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>150</h3>
                        <p>浏览管理</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-eye"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ asset('/user/funds') }}">
            <div class="col-sm-2">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>150</h3>
                        <p>资金明细</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ asset('/user/bind') }}">
            <div class="col-sm-2">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>150</h3>
                        <p>绑定店铺</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-link"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="">
            <div class="col-sm-2">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>150</h3>
                        <p>个人设置</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-sm-12">--}}
            {{--<div class="box box-solid">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h3 class="box-title">广告位招租</h3>--}}
                {{--</div>--}}
                {{--<!-- /.box-header -->--}}
                {{--<div class="box-body">--}}
                    {{--<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">--}}
                        {{--<ol class="carousel-indicators">--}}
                            {{--<li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>--}}
                            {{--<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>--}}
                            {{--<li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>--}}
                        {{--</ol>--}}
                        {{--<div class="carousel-inner">--}}
                            {{--<div class="item">--}}
                                {{--<img class="attachment-img" src="{{ asset("/bower_components/admin-lte/dist/img/photo1.png")}}" alt="First slide">--}}

                                {{--<div class="carousel-caption">--}}
                                    {{--First Slide--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="item">--}}
                                {{--<img class="img-responsive pad" src="{{ asset("/bower_components/admin-lte/dist/img/photo2.png")}}" alt="Second slide">--}}

                                {{--<div class="carousel-caption">--}}
                                    {{--Second Slide--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="item active">--}}
                                {{--<img class="img-responsive pad" src="{{ asset("/bower_components/admin-lte/dist/img/photo1.png")}}" alt="Third slide">--}}

                                {{--<div class="carousel-caption">--}}
                                    {{--Third Slide--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">--}}
                            {{--<span class="fa fa-angle-left"></span>--}}
                        {{--</a>--}}
                        {{--<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">--}}
                            {{--<span class="fa fa-angle-right"></span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.box-body -->--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">商家公告</h3>
                    <div class="box-tools">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">«</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>标题</th>
                            <th>发布时间</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Update software</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-red">55%</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
