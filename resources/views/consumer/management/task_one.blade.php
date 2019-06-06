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

<form method="post" enctype="multipart/form-data" id="task" action="{{ route('user.release_task.publish') }}">
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
                    <button type="button" onclick="task_step(1)" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-forward"></i> 下一步
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div class="row" id="step2-1">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">垫付任务</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                    <div class="row">
                    <table class="table"><tbody><tr class="danger text-center h4"><td>第一步：填写商品信息</td></tr></tbody></table>
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品名称</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input name="goods_name" placeholder="商品名称" type="text" class="form-control goods_name" required maxlength="160">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品链接</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input name="goods_url" placeholder="商品链接" type="text" class="form-control goods_url" required maxlength="300">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>商品详情页中答案词</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input class="form-control goods_keyword" name="goods_keyword" type="text" maxlength="10" required placeholder="买手查找手机详情页中答案词，目的增加买手在商品页的停留时间">
                                                <span class="help-block m-b-none text-danger">填写【<strong style="font-size:15px;color: blue">手机商品详情页，切记不是电脑商品详情页</strong>】某个词作为答案。最少2个字，最多10个字，不能带有符号、空格。</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品主图</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <div class="camera-area" data-id="1">
                                                    <input type="file" require name="goods_pic" class="fileToUpload " accept="image/*">
                                                </div>
                                                <span class="help-block m-b-none text-muted">务必亲自在手机端搜索，确保与搜索页面展示的图片一致。</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>单品售价(元)</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input name="goods_price" type="number" class="form-control goods_price task_required" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" required="required" step="0.01" placeholder="用户付款价格">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>每单拍(件)</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <input name="goods_num" type="number" class="form-control task_required goods_num" onkeyup="value=value.replace(/[^\d]/,'')" min="1" required="required" value="1" step="1">
                                                    </div>
                                                    <div class="col-sm-10"><span class="help-block m-b-none text-muted">【不含运费】</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="table"><tbody><tr class="danger text-center h4"><td>第二步：设置如何找到商品</td></tr></tbody></table>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 定位目标商品排序</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input class="sort_style" name="sort_style" require type="radio" value="0" title="销量">
                                                <span>销量</span>
                                                <input class="sort_style" name="sort_style" require type="radio" value="1" title="综合">
                                                <span>综合</span>
                                                <input class="sort_style sort_style3" require name="sort_style" type="radio" value="2" title="直通车(综合排序)">
                                                <span>直通车(综合排序)</span>
                                                <br> <span class="text-danger">强烈建议销量排序，商品位置更稳定更好找</span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>手机搜索页展示价格</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <input name="list_price" type="number" class="form-control list_price" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" required step="0.01">
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <span class="help-block m-b-none text-muted">务必亲自在手机端搜索，确认价格准确</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label">商品现有收货/付款/评价数约</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <input name="list_price" type="number" class="form-control list_price" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" step="0.01">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label">订单留言</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <textarea id="order_msg" name="order_msg" rows="3" cols="20" class="form-control" maxlength="300"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table"><tbody><tr class="danger text-center h4"><td>第三步：选择任务类型和单数</td></tr></tbody></table>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="col-sm-12 control-label"><span class="label label-danger">必填</span>选择添加推广任务类型</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="sel_type padding-lr">
                                                <div class="commen_type">
                                                    <div class="type_bar type-select">
                                                        <input class="type-check" type="checkbox" name="commen_type" value="1">
                                                        <span>自由好评任务</span>
                                                    </div>
                                                    <div class="type_content" style="display: none">
                                                        <div class="callout">
                                                            <p> <span class="label label-danger">必填</span>搜索关键词
                                                                <input name="commen_keywords" type="text" maxlength="100">
                                                                <span class="view_hide">添加垫付
                                                                <input  name="commen_num" type="number" min="1" onkeyup="value=value.replace(/[^\d]/,'')" title="一单对应一评语,设置垫付为1"> 单
                                                            </span>
                                                            </p>
                                                            <div>添加浏览任务
                                                                <input name="commen_view_num" type="number" min="1" maxlength="5" onkeyup="value=value.replace(/[^\d]/,'')"> 个 (<span class="flow-price">+0.6 元/个</span>)
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其中
                                                                <input  type="checkbox" name="commen_is_fav" value="1"> 收藏商品
                                                                <input  type="checkbox" name="commen_is_store" value="1"> 收藏店铺
                                                                <span><input type="checkbox" name="commen_is_cart" value="1"> 加购物车</span>&nbsp;&nbsp;设置
                                                                <input type="number" min="1" name="commen_fav_num" maxlength="5" onkeyup="value=value.replace(/[^\d]/,'')"> 个 (<span class="flow-price">+0.6 元/个</span>)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="appoint_type">
                                                    <div class="type_bar type-select">
                                                        <input class="type-check" type="checkbox" name="appoint_type" value="1">
                                                        <span class="view_hide">指定好评任务</span>
                                                    </div>
                                                    <div class="type_content" style="display: none">
                                                        <div class="callout">
                                                            <p> <span class="label label-danger">必填</span> 搜索关键词
                                                                <input name="appoint_keywords" type="text" maxlength="100">　
                                                                <span class="view_hide">添加垫付
                                                                <input name="appoint_num" type="number" min="1" onkeyup="value=value.replace(/[^\d]/,'')"  title="一单对应一评语,设置垫付为1"> 单
                                                            </span>
                                                            </p>
                                                            <div>添加浏览任务
                                                                <input name="appoint_view_num" type="number" min="1" maxlength="5" onkeyup="value=value.replace(/[^\d]/,'')"> 个 (<span class="flow-price">+0.6 元/个</span>)
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其中
                                                                <input  type="checkbox" name="appoint_is_fav" value="1"> 收藏商品
                                                                <input  type="checkbox" name="appoint_is_store" value="1"> 收藏店铺
                                                                <span class="pdd-hide"><input type="checkbox" name="appoint_is_cart" value="1"> 加购物车</span>&nbsp;&nbsp;设置
                                                                <input type="number" min="1" name="appoint_fav_num" maxlength="5" onkeyup="value=value.replace(/[^\d]/,'')"> 个 (<span class="flow-price">+0.6 元/个</span>)
                                                            </div>
                                                        </div>
                                                        <div class="callout">
                                                            <p><span class="label label-danger">必填</span>设置指定文字好评内容</p>
                                                            <div class="form-group">
                                                                <textarea  class="form-control" name="appoint_text" cols="95" rows="5" placeholder="可填写完整的评价内容，最多999字"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                    </div>

                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-forward"></i> 下一步
                    </button>
                    <button type="button" onclick="task_step(2)" class="btn btn-info pull-right" style="margin-right: 5px;">
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
                    <h3 class="box-title">浏览任务</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">

                    </div>
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 5px;">
                        <i class="fa fa-fast-forward"></i> 下一步
                    </button>
                    <button type="button" onclick="task_step(2)" class="btn btn-info pull-right" style="margin-right: 5px;">
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
            $("input[type='radio']").iCheck('uncheck');
            $('.shopname-list').hide();
            $('#check').hide();
        } else {
            $("input[type='radio']").iCheck('uncheck');
            $('.shopname-list').hide();
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
                // $("#task")[0].reset();
                $("input[type='radio']").iCheck('uncheck');
                $('.shopname-list').hide();
                $("#step1").show();
                $("#step2-1").hide();
                $("#step2-2").hide();
                return true;
            } else {
                return false;
            }
        }
    }
    $('.type-check').click(function(){
            $(this).parent('.type-select').next().toggle();
        })
</script>
@endpush

@endsection