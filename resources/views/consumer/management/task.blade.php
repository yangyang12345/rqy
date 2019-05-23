@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <form id="task" method="post" action="{{ route('user.release_task.publish') }}" onsubmit="return sumbit_sure()" enctype="multipart/form-data">
                        @csrf
                        <div id="wizard">

                            <div class="items">
                                <div class="page">
                                    <div style="overflow:hidden;"><img src="{{ asset('images/1.png') }}" alt=""></div>
                                    <hr>
                                    <div class="alert alert-success-self">
                                        <p> 所有商家都要注意在启拉推广务必严格控制好以下3点：</p>
                                        <p><span> 1. </span><strong style="color: red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！</strong><span style="color: red;">一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升级，有些以前没出事不代表现在或以后没事）</span>；</p>
                                        <p><span> 2. </span>近期严查，推广比例一定不要过高，最高最高不能超过40%，<strong style="color: red;">强烈推荐选择“找关键词浏览 ”任务模式</strong></p>
                                        <p><span> 3. </span>移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                                    </div>
                                    <hr>
                                    <div>
                                        <h4>第一步：选择任务类型 <a href="{{ route('help') }}">查看价格表</a></h4>
                                    </div>
                                    <div style="padding-left:50px;">
                                        <div class="form-group">
                                            <input id="wrap_task_type" name="wrap_task_type" type="radio" value="0" title="垫付任务" checked="" ><span>垫付任务</span>
                                            <input name="wrap_task_type" type="radio" value="1" title="浏览任务" ><span>浏览任务</span>
                                        </div>
                                        <hr>
                                        <ul class="tasktype-list" style="padding-left: 30px; display: block;">
                                            <li>
                                                <input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="1" >
                                                <img class="platlogo" src="{{ asset('images/t.png') }}">
                                                <span class="taskname">手机淘宝/天猫</span>任务 （用户在手机淘宝app下单）
                                            </li>
                                            {{--<li>--}}
                                                {{--<input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="2">--}}
                                                {{--<img class="platlogo" src="{{ asset('images/t.png') }}">--}}
                                                {{--<span class="taskname">淘宝<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持淘客秒拍、聚划算、淘抢购、淘金币、淘口令或其它渠道活动） </span>--}}

                                            {{--</li>--}}
                                            <li>
                                                <input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="3">
                                                <img class="platlogo" src="{{ asset('images/j.png') }}">
                                                <span class="taskname">手机京东</span>任务
                                            </li>
                                            {{--<li>--}}
                                                {{--<input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="4">--}}
                                                {{--<img class="platlogo" src="{{ asset('images/j.png') }}">--}}
                                                {{--<span class="taskname">京东<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>--}}
									{{--（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="5">
                                                <img class="platlogo" src="{{ asset('images/p.png') }}">
                                                <span class="taskname">手机拼多多</span>任务

                                            </li>
                                            {{--<li>--}}
                                                {{--<input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="6">--}}
                                                {{--<img class="platlogo" src="{{ asset('images/p.png') }}">--}}
                                                {{--<span class="taskname">拼多多<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>--}}
                                            {{--</li>--}}
                                        </ul>
                                        <ul class="tasktype-list" style="padding-left: 30px; display: none;">
                                            <li>
                                                <input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="7">
                                                <img class="platlogo" src="{{ asset('images/t.png') }}">
                                                <span class="taskname">手机淘宝/天猫浏览、收藏、加购物车（全真人加购，不被屏蔽不降权。）</span>

                                            </li>
                                            {{--<li>--}}
                                                {{--<input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="8">--}}
                                                {{--<img class="platlogo" src="{{ asset('images/t.png') }}">--}}
                                                {{--<span class="taskname">淘宝<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持淘客秒拍、聚划算、淘抢购、淘金币、淘口令或其它渠道活动） </span>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="9">
                                                <img class="platlogo" src="{{ asset('images/j.png') }}">
                                                <span class="taskname">手机京东浏览、收藏、加购物车</span>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="10">--}}
                                                {{--<img class="platlogo" src="{{ asset('images/j.png') }}">--}}
                                                {{--<span class="taskname">京东<span style="color: #157cdc;font-weight: bold;">特别</span></span>浏览任务 <span>--}}
									{{--（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="11">
                                                <img class="platlogo" src="{{ asset('images/p.png') }}">
                                                <span class="taskname">手机拼多多浏览任务 （用户在手机拼多多上操作任务）</span>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="12">--}}
                                                {{--<img class="platlogo" src="{{ asset('images/p.png') }}">--}}
                                                {{--<span class="taskname">拼多多<span style="color: #157cdc;font-weight: bold;">特别</span></span>浏览任务 <span>（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>--}}
                                            {{--</li>--}}
                                        </ul>
                                    </div>
                                    <hr>
                                    <div><h4>第二步：选择店铺 <a href="{{ route('user.bind') }}">去绑店铺</a></h4></div>
                                    <div>
                                        <div class="shopname-list" style="padding-left: 50px; display: none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                    @if($shop->type==0)
                                                        <div class="col-sm-3" style="margin-top:10px;">
                                                            <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                            <span class="label label-warning">淘宝</span> {{ $shop->store_name }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="shopname-list" style="padding-left: 50px; display: none;">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                    @if($shop->type==1)
                                                        <div class="col-sm-3" style="margin-top:10px;">
                                                            <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                            <span class="label label-warning">京东</span> {{ $shop->store_name }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="shopname-list" style="padding-left:50px;display:none">
                                            <div class="row">
                                                @foreach($shops as $shop)
                                                    @if($shop->type==2)
                                                        <div class="col-sm-3" style="margin-top:10px;">
                                                            <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" title="{{ $shop->store_name }}">
                                                            <span class="label label-warning">拼多多</span> {{ $shop->store_name }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="plantform">
                                        <h4>第三步：选择平台返款模式 </h4>
                                        <ul style="padding-left:50px; list-style: none">
                                            <li> <input class="tasktype" type="radio" checked="">平台系统返款+买号安全筛查　（收取服务费2元/单）</li>
                                            <li class="prompt"> <span class="striking">优先展示给用户</span>，商家押商品本金到平台，只需在“返款管理”中确认返款金额，一键返款给用户(<span class="striking">24小时内</span>)，商家无需耗费时间、人力处理退款。</li>
                                        </ul>
                                    </div>
                                    <div class="text-center"> <button id="firstBtn" class="btn btn-primary btn-lg next" type="button">下一步</button> </div>

                                </div>
                                <div class="page">
                                    <div style="overflow:hidden;"><img src="{{ asset('images/2.png') }}" alt=""></div>
                                    <hr>
                                    <div class="alert alert-success-self">
                                        <p> 所有商家都要注意在启拉推广务必严格控制好以下3点：</p>
                                        <p><span> 1. </span><strong style="color: red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！</strong><span style="color: red;">一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升级，有些以前没出事不代表现在或以后没事）</span>；</p>
                                        <p><span> 2. </span>近期严查，推广比例一定不要过高，最高最高不能超过40%，<strong style="color: red;">强烈推荐选择“找关键词浏览 ”任务模式</strong></p>
                                        <p><span> 3. </span>移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <table class="table"><tbody><tr class="danger text-center h4"><td>第一步：填写商品信息</td></tr></tbody></table>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品名称</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input name="goods_name" placeholder="商品名称" type="text" class="form-control goods_name" required="" maxlength="160">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品链接</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input name="goods_url" placeholder="商品链接" type="text" class="form-control goods_url" required="" maxlength="300">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>商品详情页中答案词</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input class="form-control goods_keyword" name="goods_keyword" type="text" maxlength="10" required="" placeholder="买手查找手机详情页中答案词，目的增加买手在商品页的停留时间">
                                                <span class="help-block m-b-none text-danger">填写【<strong style="font-size:15px;color: blue">手机商品详情页，切记不是电脑商品详情页</strong>】某个词作为答案。最少2个字，最多10个字，不能带有符号、空格。</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品主图</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <div class="camera-area" data-id="1">
                                                    <input type="file" name="goods_pic" class="fileToUpload " accept="image/*">
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
                                                        <input name="list_price" type="number" class="form-control list_price" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" required="" step="0.01">
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
                                                        <input name="list_price" type="number" class="form-control list_price" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" required="" step="0.01">
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
                                    <hr>
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
                                                                <input  name="commen_num" type="number" min="1" onkeyup="value=value.replace(/[^\d]/,'')" data-toggle="tooltip" title="一单对应一评语,设置垫付为1"> 单
                                                            </span>
                                                            </p>
                                                            <div>添加浏览任务
                                                                <input name="commen_view_num" type="number" min="0" maxlength="5" onkeyup="if(/[^\d\.]/.test(value))value=0"> 个 (<span class="flow-price">+0.6 元/个</span>)
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其中
                                                                <input  type="checkbox" name="commen_is_fav" value="1"> 收藏商品
                                                                <input  type="checkbox" name="commen_is_store" value="1"> 收藏店铺
                                                                <span><input type="checkbox" name="commen_is_cart" value="1"> 加购物车</span>&nbsp;&nbsp;设置
                                                                <input type="number" min="0" name="commen_fav_num" maxlength="5" onkeyup="if(/[^\d\.]/.test(value))value=0"> 个 (<span class="flow-price">+0.6 元/个</span>)
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
                                                                <input name="appoint_num" type="number" min="1" onkeyup="value=value.replace(/[^\d]/,'')" data-toggle="tooltip" title="一单对应一评语,设置垫付为1"> 单
                                                            </span>
                                                            </p>
                                                            <div>添加浏览任务
                                                                <input name="appoint_view_num" type="number" min="0" maxlength="5" onkeyup="if(/[^\d\.]/.test(value))value=0"> 个 (<span class="flow-price">+0.6 元/个</span>)
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其中
                                                                <input  type="checkbox" name="appoint_is_fav" value="1"> 收藏商品
                                                                <input  type="checkbox" name="appoint_is_store" value="1"> 收藏店铺
                                                                <span class="pdd-hide"><input type="checkbox" name="appoint_is_cart" value="1"> 加购物车</span>&nbsp;&nbsp;设置
                                                                <input type="number" min="0" name="appoint_fav_num" maxlength="5" onkeyup="if(/[^\d\.]/.test(value))value=0"> 个 (<span class="flow-price">+0.6 元/个</span>)
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
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-lg prev" type="button">上一步</button>
                                        <button class="btn btn-primary btn-lg next" type="button">下一步</button>
                                    </div>

                                </div>
                                <div class="page">
                                    <div style="overflow:hidden;"><img src="{{ asset('images/3.png') }}" alt=""></div>
                                    <hr>
                                    <div class="alert alert-success-self">
                                        <p> 所有商家都要注意在启拉推广务必严格控制好以下3点：</p>
                                        <p><span> 1. </span><strong style="color: red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！</strong><span style="color: red;">一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升级，有些以前没出事不代表现在或以后没事）</span>；</p>
                                        <p><span> 2. </span>近期严查，推广比例一定不要过高，最高最高不能超过40%，<strong style="color: red;">强烈推荐选择“找关键词浏览 ”任务模式</strong></p>
                                        <p><span> 3. </span>移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2 class="page-header">
                                                <i class="fa fa-globe"></i> {{ $capital->name }}
                                                <small class="pull-right">账户余额:{{ $capital->balance }}</small>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <input type="hidden" value="{{ time().$capital->user_id }}" name="serial">
                                            <input type="hidden" value="{{ $capital->user_id }}" name="order_user">
                                            <input type="hidden" value="{{ date('Y-m-d H:m:s',time()) }}" name="ctime">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>订单流水</th>
                                                    <th>用户名称</th>
                                                    <th>商品名称</th>
                                                    <th>商品链接</th>
                                                    <th>任务单数</th>
                                                    <th>任务所需总金额</th>
                                                    <th>订单创建时间</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{ time().$capital->user_id }}</td>
                                                    <td>{{ $capital->name }}</td>
                                                    <td><span class="goods_name_copy"></span></td>
                                                    <td><span class="goods_url_copy"></span></td>
                                                    <td><span class="task_num"></span></td>
                                                    <td><span class="task_price"></span></td>
                                                    <td>{{ date('Y-m-d H:m:s',time()) }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-primary btn-lg prev" type="button">上一步</button>
                                        <input id="sub" class="btn btn-primary btn-lg next" type="submit" value="发布">
                                    </div>
                                </div>
                                <div class="page">
                                    <div style="overflow:hidden;"><img src="{{ asset('images/4.png') }}" alt=""></div>
                                    <hr>
                                    <div class="alert alert-success-self">
                                        <p> 所有商家都要注意在启拉推广务必严格控制好以下3点：</p>
                                        <p><span> 1. </span><strong style="color: red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！</strong><span style="color: red;">一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升级，有些以前没出事不代表现在或以后没事）</span>；</p>
                                        <p><span> 2. </span>近期严查，推广比例一定不要过高，最高最高不能超过40%，<strong style="color: red;">强烈推荐选择“找关键词浏览 ”任务模式</strong></p>
                                        <p><span> 3. </span>移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('common-js')
        <script src="{{ asset("js/jquery.min.js") }}"></script>
        <script src="{{ asset("js/scrollable.js") }}"></script>
        <script>
            var user_price = '<?php echo $capital->balance;?>';
            $(document).ready(function(){
                $("#wizard").scrollable({
                    onSeek: function(event,i){
                        if (i==0){
                            $('#wizard').css('height','900px')
                        }
                        if (i==1){
                            $('#wizard').css('height','1800px')
                        }
                        if (i==2){
                            var goods_name_copy = $("input[name='goods_name']").val();
                            var goods_url_copy = $("input[name='goods_url']").val();
                            var commen_type = $("input[name='commen_type']:checked").val();
                            var appoint_type = $("input[name='appoint_type']:checked").val();

                            var c_num = 0;
                            var a_num = 0;
                            var task_num = 0;
                            var task_price = 0;
                            if(commen_type==1){
                                var commen_is_fav = $("input[name='commen_is_fav']:checked").val();
                                var commen_is_store = $("input[name='commen_is_store']:checked").val();
                                var commen_is_cart = $("input[name='commen_is_cart']:checked").val();
                                if (commen_is_fav == 1){
                                    c_num+=1;
                                }
                                if (commen_is_store == 1){
                                    c_num+=1;
                                }
                                if (commen_is_cart == 1){
                                    c_num+=1
                                }

                                var commen_num = $("input[name='commen_num']").val()==''?0:$("input[name='commen_num']").val();
                                var commen_view_num = $("input[name='commen_view_num']").val()==''?0:$("input[name='commen_view_num']").val();
                                var commen_fav_num = $("input[name='commen_fav_num']").val()==''?0:$("input[name='commen_fav_num']").val();

                                var commen_total = c_num*commen_fav_num+Number(commen_num)+Number(commen_view_num);
                                var commen_price = c_num*commen_fav_num*0.6+Number(commen_num)*2+Number(commen_view_num)*0.6;
                                task_num += commen_total;
                                task_price += commen_price
                            }

                            if(appoint_type==1){
                                var appoint_is_fav = $("input[name='appoint_is_fav']:checked").val();
                                var appoint_is_store = $("input[name='appoint_is_store']:checked").val();
                                var appoint_is_cart = $("input[name='appoint_is_cart']:checked").val();
                                if (appoint_is_fav == 1){
                                    a_num+=1;
                                }
                                if (appoint_is_store == 1){
                                    a_num+=1;
                                }
                                if (appoint_is_cart == 1){
                                    a_num+=1;
                                }

                                var appoint_num = $("input[name='appoint_num']").val()==''?0:$("input[name='appoint_num']").val();
                                var appoint_view_num = $("input[name='commen_view_num']").val()==''?0:$("input[name='commen_view_num']").val();
                                var appoint_fav_num = $("input[name='appoint_fav_num']").val()==''?0:$("input[name='appoint_fav_num']").val();

                                var appoint_total = a_num*appoint_fav_num+Number(appoint_num)+Number(appoint_view_num);
                                var appoint_price = a_num*appoint_fav_num*0.6+Number(appoint_num)*2+Number(appoint_view_num)*0.6;
                                task_num += appoint_total;
                                task_price += appoint_price

                            }


                            $('.goods_name_copy').text(goods_name_copy);
                            $('.goods_url_copy').text(goods_url_copy);
                            $('.task_num').text(task_num);
                            $('.task_price').text(task_price);

                            $('#wizard').css('height','500px')

                        }
                    },
                    onBeforeSeek:function(event,i){
                        if(i==1){
                            var task_type = $("input[name='task_type']:checked").val();
                            if(task_type===undefined){
                                alert("请先选中任务类型！");
                                return false;
                            }

                            var user = $("input[name='sid']:checked").val();
                            if(user===undefined){
                                alert("请先选择店铺！");
                                return false;
                            }
                        }

                        if(i==2){
                            var goods_name = $("input[name='goods_name']").val();
                            if(goods_name===''){
                                alert("请先填写商品名称！");
                                return false;
                            }

                            var goods_url = $("input[name='goods_url']").val();
                            if(goods_url===''){
                                alert("请先填写商品链接！");
                                return false;
                            }
                            var goods_keyword = $("input[name='goods_keyword']").val();
                            if(goods_keyword===''){
                                alert("请先填写关键词！");
                                return false;
                            }

                            var goods_pic = $("input[name='goods_pic']").val();
                            if(goods_pic===''){
                                alert("请先上传图片！");
                                return false;
                            }

                            var goods_price = $("input[name='goods_price']").val();
                            if(goods_price===''){
                                alert("请先填写商品价格！");
                                return false;
                            }

                            var goods_num = $("input[name='goods_num']").val();
                            if(goods_num===''){
                                alert("请先填写每单件数！");
                                return false;
                            }

                            var sort_style = $("input[name='sort_style']:checked").val();
                            if(sort_style===undefined){
                                alert("请先选择商品排序！");
                                return false;
                            }

                            var list_price = $("input[name='list_price']").val();
                            if(list_price===''){
                                alert("请先填写手机搜索页展示价格！");
                                return false;
                            }


                            var commen_type = $("input[name='commen_type']:checked").val();
                            var appoint_type = $("input[name='appoint_type']:checked").val();
                            if (commen_type===undefined && appoint_type ===undefined){
                                alert("请先选择任务类型！");
                                return false;
                            }

                            if(commen_type===1){
                                var commen_keywords = $("input[name='commen_keywords']").val();
                                if (commen_keywords===''){
                                    alert("请先填写类型关键词！");
                                    return false;
                                }
                                var commen_num = $("input[name='commen_num']").val();
                                if (commen_num===''){
                                    alert("请先填写添加垫付单数！");
                                    return false;
                                }

                            }
                            if(appoint_type===1){
                                var appoint_keywords = $("input[name='appoint_keywords']").val();
                                if (appoint_keywords===''){
                                    alert("请先填写类型关键词！");
                                    return false;
                                }
                                var appoint_num = $("input[name='appoint_num']").val();
                                if (appoint_num===''){
                                    alert("请先填写添加垫付单数！");
                                    return false;
                                }
                                var appoint_text = $("input[name='appoint_text']").val();
                                if (appoint_text===''){
                                    alert("请先填写指定好评文字！");
                                    return false;
                                }
                            }

                        }
                    },
                    seekTo:function(index){

                    }
                });

                $("#sub").click(function(){
                    $("#task").submit();
                });


                $("input[name='wrap_task_type']").click(function () {
                    //浏览任务
                    if($('#wrap_task_type:checked').length==0){
                        $('.tasktype-list').first().hide();
                        $('.tasktype-list').last().show();
                        $('#plantform').hide();//第三步：选择平台返款模式
                    }else{
                        $('.tasktype-list').last().hide();
                        $('.tasktype-list').first().show();
                        $('#plantform').show();
                    }
                    $(".shopname-list").hide();
                    $("input[name='sid']").removeAttr('checked');
                });

                $('.type-check').click(function(){
                    $(this).parent('.type-select').next().toggle();
                })

            });

            function show_list(id){
                $(".shopname-list:eq("+id+")").show().siblings().hide();
            }

            function sumbit_sure(){
                console.log('sumbit_sure');
                var commen_type = $("input[name='commen_type']:checked").val();
                var appoint_type = $("input[name='appoint_type']:checked").val();

                var c_num = 0;
                var a_num = 0;
                var task_price = 0;
                if(commen_type==1){
                    var commen_is_fav = $("input[name='commen_is_fav']:checked").val();
                    var commen_is_store = $("input[name='commen_is_store']:checked").val();
                    var commen_is_cart = $("input[name='commen_is_cart']:checked").val();
                    if (commen_is_fav == 1){
                        c_num+=1;
                    }
                    if (commen_is_store == 1){
                        c_num+=1;
                    }
                    if (commen_is_cart == 1){
                        c_num+=1
                    }

                    var commen_num = $("input[name='commen_num']").val()==''?0:$("input[name='commen_num']").val();
                    var commen_view_num = $("input[name='commen_view_num']").val()==''?0:$("input[name='commen_view_num']").val();
                    var commen_fav_num = $("input[name='commen_fav_num']").val()==''?0:$("input[name='commen_fav_num']").val();

                    var commen_price = c_num*commen_fav_num*0.6+Number(commen_num)*2+Number(commen_view_num)*0.6;
                    task_price += commen_price
                }

                if(appoint_type==1){
                    var appoint_is_fav = $("input[name='appoint_is_fav']:checked").val();
                    var appoint_is_store = $("input[name='appoint_is_store']:checked").val();
                    var appoint_is_cart = $("input[name='appoint_is_cart']:checked").val();
                    if (appoint_is_fav == 1){
                        a_num+=1;
                    }
                    if (appoint_is_store == 1){
                        a_num+=1;
                    }
                    if (appoint_is_cart == 1){
                        a_num+=1;
                    }

                    var appoint_num = $("input[name='appoint_num']").val()==''?0:$("input[name='appoint_num']").val();
                    var appoint_view_num = $("input[name='commen_view_num']").val()==''?0:$("input[name='commen_view_num']").val();
                    var appoint_fav_num = $("input[name='appoint_fav_num']").val()==''?0:$("input[name='appoint_fav_num']").val();

                    var appoint_price = a_num*appoint_fav_num*0.6+Number(appoint_num)*2+Number(appoint_view_num)*0.6;
                    task_price += appoint_price

                }

                if (task_price>user_price){
                    alert('您的余额不足，请先充值');
                    return false;
                }
            }
        </script>
    @endpush


@endsection