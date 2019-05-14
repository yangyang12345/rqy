@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
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
                            <li>
                                <input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="5">
                                <img class="platlogo" src="{{ asset('images/t.png') }}">
                                <span class="taskname">淘宝<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持淘客秒拍、聚划算、淘抢购、淘金币、淘口令或其它渠道活动） </span>

                            </li>
                            <li>
                                <input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="3">
                                <img class="platlogo" src="{{ asset('images/j.png') }}">
                                <span class="taskname">手机京东</span>任务
                            </li>
                            <li>
                                <input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="4">
                                <img class="platlogo" src="{{ asset('images/j.png') }}">
                                <span class="taskname">京东<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>
									（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                            </li>
                            <li>
                                <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="6">
                                <img class="platlogo" src="{{ asset('images/p.png') }}">
                                <span class="taskname">手机拼多多</span>任务

                            </li>
                            <li>
                                <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="2">
                                <img class="platlogo" src="{{ asset('images/p.png') }}">
                                <span class="taskname">拼多多<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                            </li>
                        </ul>
                        <ul class="tasktype-list" style="padding-left: 30px; display: none;">
                            <li>
                                <input class="tasktype" name="task_type" type="radio" value="7">
                                <img class="platlogo" src="{{ asset('images/t.png') }}">
                                <span class="taskname">手机淘宝/天猫浏览、收藏、加购物车（全真人加购，不被屏蔽不降权。）</span>

                            </li>
                            <li>
                                <input class="tasktype" name="task_type" type="radio" value="10">
                                <img class="platlogo" src="{{ asset('images/t.png') }}">
                                <span class="taskname">淘宝<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持淘客秒拍、聚划算、淘抢购、淘金币、淘口令或其它渠道活动） </span>
                            </li>
                            <li>
                                <input class="tasktype" name="task_type" type="radio" value="8">
                                <img class="platlogo" src="{{ asset('images/j.png') }}">
                                <span class="taskname">手机京东浏览、收藏、加购物车</span>
                            </li>
                            <li>
                                <input class="tasktype" name="task_type" type="radio" value="11">
                                <img class="platlogo" src="{{ asset('images/j.png') }}">
                                <span class="taskname">京东<span style="color: #157cdc;font-weight: bold;">特别</span></span>浏览任务 <span>
									（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                            </li>
                            <li>
                                <input class="tasktype" name="task_type" type="radio" value="9">
                                <img class="platlogo" src="{{ asset('images/p.png') }}">
                                <span class="taskname">手机拼多多浏览任务 （用户在手机拼多多上操作任务）</span>
                            </li>
                            <li>
                                <input class="tasktype" name="task_type" type="radio" value="12">
                                <img class="platlogo" src="{{ asset('images/p.png') }}">
                                <span class="taskname">拼多多<span style="color: #157cdc;font-weight: bold;">特别</span></span>浏览任务 <span>（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div><h4>第二步：选择店铺 <a class="pull-right1" href="{{ route('user.bind') }}">去绑店铺</a></h4></div>
                    <div>
                        <div class="shopname-list" style="padding-left: 50px; display: none;">
                            <div class="row">
                                @foreach($shops as $shop)
                                    @if($shop->type==0)
                                        <div class="col-sm-3" style="margin-top:10px;">
                                            <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" checked="" title="{{ $shop->store_name }}">
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
                                            <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" checked="" title="{{ $shop->store_name }}">
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
                                            <input class="tasktype sid" name="sid" type="radio" value="{{ $shop->id }}" checked="" title="{{ $shop->store_name }}">
                                            <span class="label label-warning">拼多多</span> {{ $shop->store_name }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="step3">
                        <h4>第三步：选择平台返款模式 </h4>
                        <ul style="padding-left:50px; list-style: none">
                            <li> <input cclass="tasktype" type="radio" checked="">平台系统返款+买号安全筛查　（收取服务费2元/单）</li>
                            <li class="prompt"> <span class="striking">优先展示给用户</span>，商家押商品本金到平台，只需在“返款管理”中确认返款金额，一键返款给用户(<span class="striking">24小时内</span>)，商家无需耗费时间、人力处理退款。</li>
                        </ul>
                    </div>
                    {{--<div class="stepCont stepCont1">--}}
                        {{--<!-- <div class="ystep"></div> -->--}}
                        {{--<div class='ystep-container ystep-lg ystep-blue'></div>--}}
                        {{--<div class="pageCont">--}}
                            {{----}}
                            {{--<div id="page2" class="stepPage">--}}
                                {{--<h1>page2</h1>--}}
                            {{--</div>--}}
                            {{--<div id="page3" class="stepPage">--}}
                                {{--<section class="invoice">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-xs-12">--}}
                                            {{--<h2 class="page-header">--}}
                                                {{--<i class="fa fa-globe"></i> AdminLTE, Inc.--}}
                                                {{--<small class="pull-right">Date: 2/10/2014</small>--}}
                                            {{--</h2>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row invoice-info">--}}
                                        {{--<div class="col-sm-4 invoice-col">--}}
                                            {{--From--}}
                                            {{--<address>--}}
                                                {{--<strong>Admin, Inc.</strong><br>--}}
                                                {{--795 Folsom Ave, Suite 600<br>--}}
                                                {{--San Francisco, CA 94107<br>--}}
                                                {{--Phone: (804) 123-5432<br>--}}
                                                {{--Email: info@almasaeedstudio.com--}}
                                            {{--</address>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-4 invoice-col">--}}
                                            {{--To--}}
                                            {{--<address>--}}
                                                {{--<strong>John Doe</strong><br>--}}
                                                {{--795 Folsom Ave, Suite 600<br>--}}
                                                {{--San Francisco, CA 94107<br>--}}
                                                {{--Phone: (555) 539-1037<br>--}}
                                                {{--Email: john.doe@example.com--}}
                                            {{--</address>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-4 invoice-col">--}}
                                            {{--<b>Invoice #007612</b><br>--}}
                                            {{--<br>--}}
                                            {{--<b>Order ID:</b> 4F3S8J<br>--}}
                                            {{--<b>Payment Due:</b> 2/22/2014<br>--}}
                                            {{--<b>Account:</b> 968-34567--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row">--}}
                                        {{--<div class="col-xs-12 table-responsive">--}}
                                            {{--<table class="table table-striped">--}}
                                                {{--<thead>--}}
                                                {{--<tr>--}}
                                                    {{--<th>Qty</th>--}}
                                                    {{--<th>Product</th>--}}
                                                    {{--<th>Serial #</th>--}}
                                                    {{--<th>Description</th>--}}
                                                    {{--<th>Subtotal</th>--}}
                                                {{--</tr>--}}
                                                {{--</thead>--}}
                                                {{--<tbody>--}}
                                                {{--<tr>--}}
                                                    {{--<td>1</td>--}}
                                                    {{--<td>Call of Duty</td>--}}
                                                    {{--<td>455-981-221</td>--}}
                                                    {{--<td>El snort testosterone trophy driving gloves handsome</td>--}}
                                                    {{--<td>$64.50</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td>1</td>--}}
                                                    {{--<td>Need for Speed IV</td>--}}
                                                    {{--<td>247-925-726</td>--}}
                                                    {{--<td>Wes Anderson umami biodiesel</td>--}}
                                                    {{--<td>$50.00</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td>1</td>--}}
                                                    {{--<td>Monsters DVD</td>--}}
                                                    {{--<td>735-845-642</td>--}}
                                                    {{--<td>Terry Richardson helvetica tousled street art master</td>--}}
                                                    {{--<td>$10.70</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td>1</td>--}}
                                                    {{--<td>Grown Ups Blue Ray</td>--}}
                                                    {{--<td>422-568-642</td>--}}
                                                    {{--<td>Tousled lomo letterpress</td>--}}
                                                    {{--<td>$25.99</td>--}}
                                                {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row">--}}
                                        {{--<!-- accepted payments column -->--}}
                                        {{--<div class="col-xs-6">--}}
                                            {{--<p class="lead">Payment Methods:</p>--}}
                                            {{--<img src="../../dist/img/credit/visa.png" alt="Visa">--}}
                                            {{--<img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
                                            {{--<img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
                                            {{--<img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}

                                            {{--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">--}}
                                                {{--Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg--}}
                                                {{--dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                                            {{--</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xs-6">--}}
                                            {{--<p class="lead">Amount Due 2/22/2014</p>--}}

                                            {{--<div class="table-responsive">--}}
                                                {{--<table class="table">--}}
                                                    {{--<tbody><tr>--}}
                                                        {{--<th style="width:50%">Subtotal:</th>--}}
                                                        {{--<td>$250.30</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Tax (9.3%)</th>--}}
                                                        {{--<td>$10.34</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Shipping:</th>--}}
                                                        {{--<td>$5.80</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Total:</th>--}}
                                                        {{--<td>$265.24</td>--}}
                                                    {{--</tr>--}}
                                                    {{--</tbody></table>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row no-print">--}}
                                        {{--<div class="col-xs-12">--}}
                                            {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
                                            {{--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment--}}
                                            {{--</button>--}}
                                            {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
                                                {{--<i class="fa fa-download"></i> Generate PDF--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</section>--}}
                            {{--</div>--}}
                            {{--<div id="page4" class="stepPage">--}}
                                {{--<h1>page4</h1>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>
    </div>

    @push('common-js')
        <script>
            $(document).ready(function(){

                $("input[name='wrap_task_type']").click(function () {
                    //浏览任务
                    if($('#wrap_task_type:checked').length==0){
                        $('.tasktype-list').first().hide();
                        $('.tasktype-list').last().show();
                        $('#step3').hide();//第三步：选择平台返款模式
                    }else{
                        $('.tasktype-list').last().hide();
                        $('.tasktype-list').first().show();
                        $('#step3').show();
                    }
                });

            });


            function show_list(id){
                $(".shopname-list:eq("+id+")").show().siblings().hide();
            }
        </script>
    @endpush


@endsection