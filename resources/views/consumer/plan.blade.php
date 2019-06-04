@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h5 class="box-title">推广赚金</h5>
                </div>
                <div class="box-body text-center"><img class="img-responsive" src="{{ asset('/images/ivt_top.png') }}"></div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm-3">
            <div class="box box-default">
                <div class="box-header with-border">
                    <span class="label label-primary pull-right">单位人</span>
                    <i class="fa fa-rmb"></i>
                    <h3 class="box-title">累计邀请</h3>
                </div>
                <div class="box-body">
                    <h2>5.00</h2>
                    <small>人数</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box box-default">
                <div class="box-header with-border">
                    <span class="label label-primary pull-right">单位元</span>
                    <i class="fa fa-rmb"></i>
                    <h3 class="box-title">累计分成</h3>
                </div>
                <div class="box-body">
                    <h2>5.00</h2>
                    <small>人民币</small>
                    <a href="#" onclick="">
                        <div class="pull-right font-bold text-primary">明细 <i class="fa fa-level-up"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box box-default">
                <div class="box-header with-border">
                    <span class="label label-primary pull-right">单位元</span>
                    <i class="fa fa-rmb"></i>
                    <h3 class="box-title">邀请买手累计提成</h3>
                </div>
                <div class="box-body">
                    <h2>5.00</h2>
                    <small>人民币</small>
                    <a href="#" onclick="">
                        <div class="pull-right font-bold text-primary">明细 <i class="fa fa-level-up"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box box-default">
                <div class="box-header with-border">
                    <span class="label label-primary pull-right">单位元</span>
                    <i class="fa fa-rmb"></i>
                    <h3 class="box-title">邀请商家累计提成</h3>
                </div>
                <div class="box-body">
                    <h2>5.00</h2>
                    <small>人民币</small>
                    <a href="#" onclick="">
                        <div class="pull-right font-bold text-primary">明细 <i class="fa fa-level-up"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header"><h5 class="box-title">邀请商家注册链接</h5></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            <div style="margin:10px auto;" id="ad_qcode">
                                @php
                                    $reg = route('register',['recommend'=>Auth::id()]);
                                @endphp
                            {!! QrCode::size(200)->generate($reg); !!}
                            </div>
                        </div>
                        <div class="col-sm-9"><p class="font-90 text-muted m-b-1">将商家注册链接发送给朋友注册,您可获得推广佣金</p>
                            <input type="text" class="form-control" id="turl" value="{{ $reg }}"> <br>
                            {{--<button class="btn btn-danger" href="javascript:" id="fuzhi">复制链接</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header"><h5 class="box-title">邀请买家注册链接</h5></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            <div style="margin:10px auto;" id="ad_qcode1">
                                @php
                                    $reg_m = route('register.consumer',['recommend'=>Auth::id(),'type'=>'1']);
                                @endphp
                            {!! QrCode::size(200)->generate($reg_m); !!}
                            </div>
                        </div>
                        <div class="col-sm-9"><p class="font-90 text-muted m-b-1">将买家注册链接发送给朋友注册,您可获得推广佣金</p>
                            <input type="text" class="form-control" id="turl1" value="{{ $reg_m }}"> <br>
                            {{--<button class="btn btn-danger" href="javascript:" id="fuzhi1">复制链接</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection