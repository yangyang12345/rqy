@extends('admin/base_template/dashboard')
@section('content')
@if(!empty(session('success')))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif
@if(!empty(session('fail')))
<div class="alert alert-danger" role="alert">
    {{session('fail')}}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="post" onsubmit="return task_step(2)" action="{{ route('user.release_task.publish') }}">
    @csrf
    <div class="row" id="step1">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <ul class="timeline">
                            <li class="time-label">
                                <span class="bg-green">第一步-选择任务类型</span>
                            </li>
                            <li>
                                <i class="fa bg-blue">1</i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">选择任务类型</h3>

                                    <div class="timeline-body">
                                        <div class="form-group">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_card" data-toggle="tab" aria-expanded="true">垫付任务</a></li>
                                                    <li class=""><a href="#tab_online" data-toggle="tab" aria-expanded="false">浏览任务</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_card">
                                                        <div class="form-group">
                                                            <input type="radio" name="tasktype" class="tasktype" value="1">
                                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                                            <span class="taskname">手机淘宝/天猫</span>任务 （用户在手机淘宝app下单）
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="3">
                                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                                            <span class="taskname">手机京东</span>任务
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="5">
                                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                                            <span class="taskname">手机拼多多</span>任务
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_online">
                                                        <div class="form-group">
                                                            <input type="radio" name="tasktype" class="tasktype" value="7">
                                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                                            <span class="taskname">手机淘宝/天猫浏览、收藏、加购物车（全真人加购，不被屏蔽不降权。）</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="9">
                                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                                            <span class="taskname">手机京东浏览、收藏、加购物车</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="11">
                                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                                            <span class="taskname">手机拼多多浏览任务 （用户在手机拼多多上操作任务）</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa bg-aqua">2</i>
                                <div class="timeline-item">

                                    <h3 class="timeline-header no-border">选择店铺&nbsp;<a href="{{ route('user.bind') }}" style="font-size:14px;">去绑店铺</a></h3>
                                    <div class="timeline-body">
                                        <div class="shopname-list" style="display: none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                @if($shop->type==0)
                                                <div class="col-sm-3">
                                                    <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                    <span class="label label-warning">淘宝</span> {{ $shop->store_name }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="shopname-list" style="display: none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                @if($shop->type==1)
                                                <div class="col-sm-3">
                                                    <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                    <span class="label label-warning">京东</span> {{ $shop->store_name }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="shopname-list" style="display:none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                @if($shop->type==2)
                                                <div class="col-sm-3">
                                                    <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                    <span class="label label-warning">拼多多</span> {{ $shop->store_name }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li id="check">
                                <i class="fa bg-yellow">3</i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">人工审核</h3>
                                    <div class="timeline-body">
                                        <p>平台系统返款+买号安全筛查　（收取服务费2元/单）</p>
                                        <p><span class="striking">优先展示给用户</span>，商家押商品本金到平台，只需在“返款管理”中确认返款金额，一键返款给用户(24小时内)，商家无需耗费时间、人力处理退款。</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <a onclick="task_step(1)" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-forward"></i> 下一步
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row" id="step2-1" style="display:none">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <ul class="timeline">
                            <li class="time-label">
                                <span class="bg-green">第二步-填写相关信息</span>
                            </li>
                            <li>
                                <i class="fa bg-blue">1</i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">填写商品信息</h3>

                                    <div class="timeline-body">
                                        <div class="form-group">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_card" data-toggle="tab" aria-expanded="true">垫付任务</a></li>
                                                    <li class=""><a href="#tab_online" data-toggle="tab" aria-expanded="false">浏览任务</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_card">
                                                        <div class="form-group">
                                                            <input type="radio" name="tasktype" class="tasktype" value="1">
                                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                                            <span class="taskname">手机淘宝/天猫</span>任务 （用户在手机淘宝app下单）
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="3">
                                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                                            <span class="taskname">手机京东</span>任务
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="5">
                                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                                            <span class="taskname">手机拼多多</span>任务
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_online">
                                                        <div class="form-group">
                                                            <input type="radio" name="tasktype" class="tasktype" value="7">
                                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                                            <span class="taskname">手机淘宝/天猫浏览、收藏、加购物车（全真人加购，不被屏蔽不降权。）</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="9">
                                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                                            <span class="taskname">手机京东浏览、收藏、加购物车</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="tasktype" name="tasktype" type="radio" value="11">
                                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                                            <span class="taskname">手机拼多多浏览任务 （用户在手机拼多多上操作任务）</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa bg-aqua">2</i>
                                <div class="timeline-item">

                                    <h3 class="timeline-header no-border">选择店铺&nbsp;<a href="{{ route('user.bind') }}" style="font-size:14px;">去绑店铺</a></h3>
                                    <div class="timeline-body">
                                        <div class="shopname-list" style="display: none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                @if($shop->type==0)
                                                <div class="col-sm-3">
                                                    <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                    <span class="label label-warning">淘宝</span> {{ $shop->store_name }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="shopname-list" style="display: none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                @if($shop->type==1)
                                                <div class="col-sm-3">
                                                    <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                    <span class="label label-warning">京东</span> {{ $shop->store_name }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="shopname-list" style="display:none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                @if($shop->type==2)
                                                <div class="col-sm-3">
                                                    <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                    <span class="label label-warning">拼多多</span> {{ $shop->store_name }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li id="check">
                                <i class="fa bg-yellow">3</i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">人工审核</h3>
                                    <div class="timeline-body">
                                        <p>平台系统返款+买号安全筛查　（收取服务费2元/单）</p>
                                        <p><span class="striking">优先展示给用户</span>，商家押商品本金到平台，只需在“返款管理”中确认返款金额，一键返款给用户(24小时内)，商家无需耗费时间、人力处理退款。</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-forward"></i> 下一步
                    </button>
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-backward"></i> 上一步
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div class="row" id="step2-2" style="display:none">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <input type="hidden" value="1" name="step">
                    <input type="hidden" name="tasktype">
                    <input type="hidden" name="sid">
                    <div class="col-md-12">

                    </div>
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-forward"></i> 下一步
                    </button>
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-backward"></i> 上一步
                    </button>
                </div>
            </div>
        </div>

    </div>

</form>


@push('common-js')
<script>
    $(function() {
        var id = $('input[type="radio"].tasktype:checked').val();
        if (id != null) {
            shop_show(id);
        }
    })

    $('input[type="radio"].tasktype').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    }).on('ifClicked', function() {
        var id = $(this).val();
        shop_show(id);
    });
    $('.nav-tabs-custom ul li').on('click', function() {
        if ($('.nav-tabs-custom ul li:eq(0)').is('.active')) {
            $('#check').hide();
        } else {
            $('#check').show();
        }
    })

    function shop_show(id) {

        if ($.inArray(id, ['1', '7']) != -1) {
            $('.shopname-list:eq(0)').show().siblings().hide();
        }
        if ($.inArray(id, ['3', '9']) != -1) {
            $('.shopname-list:eq(1)').show().siblings().hide();
        }
        if ($.inArray(id, ['5', '11']) != -1) {
            $('.shopname-list:eq(2)').show().siblings().hide();
        }
    }

    function task_step(id) {
        if (id == 1) {

            var task_id = $('input[type="radio"].tasktype:checked').val();
            if (task_id == null) {
                alert('请先选择类型！');
                return false;
            }

            var sid = $('input[type="radio"].sid:checked').val();
            if (sid == null) {
                alert('请先选择店铺！');
                return false;
            }

            if ($('.nav-tabs-custom ul li:eq(0)').is('.active')) {
                $("#step1").hide();
                $("#step2-1").show();
            } else {
                $("#step1").hide();
                $("#step2-2").show();
            }

        }
        if (id == 2) {
            if (confirm("确定要返回吗，返回将不保存现有数据？")) {
                return true;
            } else {
                return false;
            }
        }
    }
</script>
@endpush

@endsection