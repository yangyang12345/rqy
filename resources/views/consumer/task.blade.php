@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <div class="stepCont stepCont1">
                        <!-- <div class="ystep"></div> -->
                        <div class='ystep-container ystep-lg ystep-blue'></div>
                        <div class="pageCont">
                            <div id="page1" class="stepPage">
                                <h3>1.请选择任务类型</h3>
                                <div class="alert alert-success-self">
                                    <h4> 所有商家都要注意在启拉推广务必严格控制好以下3点：</h4>
                                    <p><span> 1. </span><strong style="color: red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！</strong><span style="color: red;">一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升级，有些以前没出事不代表现在或以后没事）</span>；</p>
                                    <p><span> 2. </span>近期严查，推广比例一定不要过高，最高最高不能超过40%，<strong style="color: red;">强烈推荐选择“找关键词浏览 ”任务模式</strong></p>
                                    <p><span> 3. </span>移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                                </div>
                                <hr>
                                <div>
                                    <h4>第一步：选择任务类型 <a href="#">查看价格表</a></h4>
                                </div>
                                <div style="padding-left:50px;">
                                    <div class="form-group">
                                        <input id="wrap_task_type" name="wrap_task_type" type="radio" value="0" title="垫付任务" checked="" ><span>垫付任务</span>
                                        <input name="wrap_task_type" type="radio" value="1" title="浏览任务" ><span>浏览任务</span>
                                    </div>
                                    <hr>
                                    <ul class="tasktype-list" style="padding-left: 30px; display: block;">
                                        <li>
                                            <input class="tasktype" name="task_type" type="radio" value="1" >
                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                            <span class="taskname">手机淘宝/天猫</span>任务 （用户在手机淘宝app下单）
                                        </li>
                                        <li>
                                            <input class="tasktype" name="task_type" type="radio" value="5">
                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                            <span class="taskname">淘宝<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持淘客秒拍、聚划算、淘抢购、淘金币、淘口令或其它渠道活动） </span>

                                        </li>
                                        <li>
                                            <input class="tasktype" name="task_type" type="radio" value="3">
                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                            <span class="taskname">手机京东</span>任务
                                        </li>
                                        <li>
                                            <input class="tasktype" name="task_type" type="radio" value="4">
                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                            <span class="taskname">京东<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>
									（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                                        </li>
                                        <li>
                                            <input class="tasktype" name="task_type" type="radio" value="6">
                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                            <span class="taskname">手机拼多多</span>任务

                                        </li>
                                        <li>
                                            <input class="tasktype" name="task_type" type="radio" value="2">
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
                            </div>
                            <div id="page2" class="stepPage">
                                <h1>page2</h1>
                            </div>
                            <div id="page3" class="stepPage">
                                <h1>page3</h1>
                            </div>
                            <div id="page4" class="stepPage">
                                <h1>page4</h1>
                            </div>
                            <div id="page5" class="stepPage">
                                <h1>page5</h1>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('step-css')
        <link rel="stylesheet" type="text/css" href="{{ asset("/css/step.css")}}">
    @endpush

    @push('step-js')
        <script src="{{ asset("/js/step.js") }}"></script>
        <script>
            $(document).ready(function(){
                var step=new SetStep({
                    content:'.stepCont1',
                    clickAble:false,
                    steps:['','','',''],
                    stepCounts:4,//总共的步骤数
                })
            });
        </script>
    @endpush


@endsection