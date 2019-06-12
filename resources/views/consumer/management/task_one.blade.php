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

<form method="post" onsubmit="return task_sub()" enctype="multipart/form-data" id="task" action="{{ route('user.release_task.publish') }}">
    @csrf
    <div class="row" id="step1">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <input type="hidden" name="wrap_type" value="0">
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

    <div class="row" id="step2" style="display:none;">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">发布任务</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="row">
                            <table class="table">
                                <tbody>
                                    <tr class="danger text-center h4">
                                        <td>第一步：填写商品信息</td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        <input type="file" required name="goods_pic" class="fileToUpload " accept="image/*">
                                    </div>
                                    <span class="help-block m-b-none text-muted">务必亲自在手机端搜索，确保与搜索页面展示的图片一致。</span>
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>单品售价(元)</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input name="goods_price" type="number" class="form-control goods_price task_required" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" required step="0.01" placeholder="用户付款价格">
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>每单拍(件)</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input name="goods_num" type="number" class="form-control task_required goods_num" onkeyup="value=value.replace(/[^\d]/,'')" min="1" required value="1" step="1">
                                        </div>
                                        <div class="col-sm-10"><span class="help-block m-b-none text-muted">【不含运费】</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table class="table">
                            <tbody>
                                <tr class="danger text-center h4">
                                    <td>第二步：设置如何找到商品</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 定位目标商品排序</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input class="sort_style" name="sort_style" type="radio" value="0" title="销量">
                                    <span>销量</span>
                                    <input class="sort_style" name="sort_style" type="radio" value="1" title="综合">
                                    <span>综合</span>
                                    <input class="sort_style sort_style3" name="sort_style" type="radio" value="2" title="直通车(综合排序)">
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
                            <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>是否允许筛选</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input class="filter" name="filter" type="radio" value="0">&nbsp;&nbsp;否&nbsp;&nbsp;&nbsp;
                                            <input class="filter" name="filter" type="radio" value="1">&nbsp;&nbsp;是
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
                        <table class="table">
                            <tbody>
                                <tr class="danger text-center h4">
                                    <td>第三步：填写订单相关信息</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 搜索关键词</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input class="form-control" name="commen_keywords" type="text" maxlength="100" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 添加任务单数</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                <input class="form-control task_required" name="commen_num" type="number" min="1" required onkeyup="value=value.replace(/[^\d]/,'')" title="一单对应一评语,设置垫付为1">
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

</form>

<div class="modal fade" id="model_task" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                    订单确认
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div class="panel">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                商品基本信息
                            </a>
                        </h4>
                    </div>
                    <div id="goods_info" class="panel-collapse collapse in">
                        <div class="box-body">
                            <div class="invoice-col">
                                <label>商品名称：</label><strong class="goods_name"></strong><br>
                                <label>商品链接：</label><span class="goods_url" style="word-wrap:break-word"></span><br>
                                <label>商品价格：</label><span class="goods_price"></span><br>
                                <label>商品关键字：</label><span class="goods_keyword"></span><br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#order_info">
                                订单基本信息
                            </a>
                        </h4>
                    </div>
                    <div id="order_info" class="panel-collapse collapse in">
                        <div class="box-body">
                            <div class="invoice-col">
                                <label>搜索关键字：</label><span class="search_key"></span><br>
                                <label>订单数目：</label><span class="order_num"></span><br>
                                <label>订单总价格：</label><span class="order_price"></span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" name="submit" class="btn btn-primary">确认</button>
            </div>
        </div>
    </div>
</div>


@push('common-js')
<script>
    $('input[type="radio"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('input[type="radio"].tasktype').on('ifClicked', function() {
        var id = $(this).val();
        $("input[type='radio'].sid").iCheck('uncheck');
        shop_show(id);
    });

    $('input[type="radio"].sort_style:eq(0)').iCheck('check');
    $('input[type="radio"].filter:eq(0)').iCheck('check');

    $('.nav-tabs-custom ul li').on('click', function() {
        if ($('.nav-tabs-custom ul li:eq(0)').is('.active')) {
            $("input[type='radio'].sid").iCheck('uncheck');
            $("input[type='radio'].tasktype").iCheck('uncheck');
            $("input[type='hidden'].wrap_type").val('0');
            $('.shopname-list').hide();
            $('#check').hide();
        } else {
            $("input[type='radio'].sid").iCheck('uncheck');
            $("input[type='radio'].tasktype").iCheck('uncheck');
            $("input[type='hidden'].wrap_type").val('1');
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
                $('#step2').show();
                $('div').removeClass('hide');
            } else {
                $("#step1").hide();
                $('#step2').show();
                $('.task_required').removeAttr('required');
            }

        }
        if (id == 2) {
            if (confirm("确定要返回吗，返回将不保存现有数据？")) {
                window.location.reload();
                return true;
            } else {
                return false;
            }
        }
    }

    function task_sub() {
        // $price = ($('input[type="text"].goods_price').val()*$('input[type="text"].goods_num').val()+2)*$('input[type="text"].commen_num').val();
        // $('.goods_name').text($('input[type="text"].goods_name').val());
        // $('.goods_url').text($('input[type="text"].goods_url').val());
        // $('.goods_price').text($('input[type="text"].goods_price').val());
        // $('.goods_keyword').text($('input[type="text"].goods_keyword').val());

        // $('.search_key').text($('input[type="text"].commen_keywords').val());
        // $('.order_num').text($('input[type="text"].commen_num').val());
        // $('.order_price').text($price);
        // $('#model_task').modal('toggle');
        // if()
        if (confirm("是否确认订单")) {
                return true;
            } else {
                return false;
            }
    }

    // $('.type-check').click(function() {
    //     $(this).parent('.type-select').next().toggle();
    // })
</script>
@endpush

@endsection