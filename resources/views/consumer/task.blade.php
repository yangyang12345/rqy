@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <div id="wizard">
                        {{--<ul id="status">--}}
                            {{--<li class="active"><strong>1.</strong>创建账户</li>--}}
                            {{--<li><strong>2.</strong>填写联系信息</li>--}}
                            {{--<li><strong>3.</strong>完成</li>--}}
                        {{--</ul>--}}

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
                                        <li>
                                            <input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="2">
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
                                            <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="5">
                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                            <span class="taskname">手机拼多多</span>任务

                                        </li>
                                        <li>
                                            <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="6">
                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                            <span class="taskname">拼多多<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                                        </li>
                                    </ul>
                                    <ul class="tasktype-list" style="padding-left: 30px; display: none;">
                                        <li>
                                            <input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="7">
                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                            <span class="taskname">手机淘宝/天猫浏览、收藏、加购物车（全真人加购，不被屏蔽不降权。）</span>

                                        </li>
                                        <li>
                                            <input onclick="show_list(0)" class="tasktype" name="task_type" type="radio" value="8">
                                            <img class="platlogo" src="{{ asset('images/t.png') }}">
                                            <span class="taskname">淘宝<span style="color: #157cdc;font-weight: bold;">特别</span></span>任务 <span>（支持淘客秒拍、聚划算、淘抢购、淘金币、淘口令或其它渠道活动） </span>
                                        </li>
                                        <li>
                                            <input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="9">
                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                            <span class="taskname">手机京东浏览、收藏、加购物车</span>
                                        </li>
                                        <li>
                                            <input onclick="show_list(1)" class="tasktype" name="task_type" type="radio" value="10">
                                            <img class="platlogo" src="{{ asset('images/j.png') }}">
                                            <span class="taskname">京东<span style="color: #157cdc;font-weight: bold;">特别</span></span>浏览任务 <span>
									（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                                        </li>
                                        <li>
                                            <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="11">
                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                            <span class="taskname">手机拼多多浏览任务 （用户在手机拼多多上操作任务）</span>
                                        </li>
                                        <li>
                                            <input onclick="show_list(2)" class="tasktype" name="task_type" type="radio" value="12">
                                            <img class="platlogo" src="{{ asset('images/p.png') }}">
                                            <span class="taskname">拼多多<span style="color: #157cdc;font-weight: bold;">特别</span></span>浏览任务 <span>（支持购买链接转二维码、自定义链接转二维码、各类活动搜索或其它渠道活动） </span>
                                        </li>
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
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品名称</label>
                                    <div class="col-sm-10">
                                        <input name="goods_name" type="text" class="form-control goods_name" required="" maxlength="160">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品链接</label>
                                    <div class="col-sm-10">
                                        <input name="goods_url[]" placeholder="商品链接" type="text" class="form-control goods_url" required="" maxlength="300">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>商品详情页中答案词</label>
                                    <div class="col-sm-10">
                                        <input class="form-control goods_keyword" name="goods_keyword[]" type="text" maxlength="10" required="" placeholder="买手查找手机详情页中答案词，目的增加买手在商品页的停留时间">
                                        <span class="help-block m-b-none text-danger">填写【<strong style="font-size:15px;color: blue">手机商品详情页，切记不是电脑商品详情页</strong>】某个词作为答案。最少2个字，最多10个字，不能带有符号、空格。</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="label label-danger">必填</span> 商品主图</label>
                                    <div class="col-sm-10">
                                        <div class="camera-area" data-id="1">
                                            <input class="goods_pic save" type="hidden" name="goods_pic[]">
                                            <input type="file" class="fileToUpload" required="" accept="image/*">
                                            <span><p class="thumb_template"></p></span> <span class="upload_progress"></span>
                                        </div>
                                        <span class="help-block m-b-none text-muted">务必亲自在手机端搜索，确保与搜索页面展示的图片一致。</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>单品售价(元)</label>
                                    <div class="col-sm-10">
                                        <input name="goods_price[]" type="number" class="form-control goods_price task_required" onkeyup="if(/[^\d\.]/.test(value))value=0" min="1" required="required" step="0.01" placeholder="用户付款价格">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="label label-danger">必填</span>每单拍(件)</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <input name="goods_num[]" type="number" class="form-control task_required goods_num" onkeyup="value=value.replace(/[^\d]/,'')" min="1" required="required" value="1" step="1">
                                            </div>
                                            <div class="col-sm-10"><span class="help-block m-b-none text-muted">【不含运费】</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <table class="table"><tbody><tr class="danger text-center h4"><td>第二步：设置如何找到商品</td></tr></tbody></table>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-lg prev" type="button">上一步</button>
                                    <button class="btn btn-primary btn-lg next" type="button">下一步</button>
                                </div>
                                {{--<div class="btn_nav">--}}
                                    {{--<input type="button" class="prev" style="float:left" value="&laquo;上一步" />--}}
                                    {{--<input type="button" class="next right" value="下一步&raquo;" />--}}
                                {{--</div>--}}
                            </div>
                            <div class="page">
                                <h3>完成注册<br/><em>点击确定完成注册。</em></h3>
                                <h4>Txcomcom欢迎您！</h4>
                                <p>请点击“确定”按钮完成注册。</p>
                                <br/>
                                <br/>
                                <br/>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-lg prev" type="button">上一步</button>
                                    <button class="btn btn-primary btn-lg next" type="button">下一步</button>
                                </div>
                            </div>
                            <div class="page">
                                <h3>完成注册<br/><em>点击确定完成注册。</em></h3>
                                <h4>Txcomcom欢迎您！</h4>
                                <p>请点击“确定”按钮完成注册。</p>
                                <br/>
                                <br/>
                                <br/>
                                <div class="btn_nav">
                                    <input type="button" class="prev" style="float:left" value="&laquo;上一步" />
                                    <input type="button" class="next right" id="sub" value="确定" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('common-js')
        <script src="{{ asset("js/jquery.min.js") }}"></script>
        <script src="{{ asset("js/scrollable.js") }}"></script>
        <script>
            $(document).ready(function(){
                $("#wizard").scrollable({
                    onSeek: function(event,i){
                        // $("#status li").removeClass("active").eq(i).addClass("active");
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

                        // if(i==2){
                        //     var task_type = $("input[name='task_type']:checked").val();
                        //     if(task_type===undefined){
                        //         alert("请先选中任务类型！");
                        //         return false;
                        //     }
                        //
                        //     var user = $("input[name='sid']:checked").val();
                        //     if(user===undefined){
                        //         alert("请先选择店铺！");
                        //         return false;
                        //     }
                        // }
                    }
                });
                $("#sub").click(function(){
                    var data = $("form").serialize();
                    alert(data);
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

            });

            function show_list(id){
                $(".shopname-list:eq("+id+")").show().siblings().hide();
            }
        </script>
    @endpush


@endsection