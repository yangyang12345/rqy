@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">发布推广任务</h3>
                </div>
                <div class="box-body">
                    <div style="overflow:hidden;"><img src="{{ asset('images/4.png') }}" alt=""></div>
                    <hr>
                    <div class="alert alert-success-self">
                        <p> 所有商家都要注意在启拉推广务必严格控制好以下3点：</p>
                        <p><span> 1. </span><strong style="color: red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！</strong><span style="color: red;">一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升级，有些以前没出事不代表现在或以后没事）</span>；</p>
                        <p><span> 2. </span>近期严查，推广比例一定不要过高，最高最高不能超过40%，<strong style="color: red;">强烈推荐选择“找关键词浏览 ”任务模式</strong></p>
                        <p><span> 3. </span>移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="text-center bg-green">任务发布成功，请前往相关页面查看</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <img class="img-responsive center-block" width="400px" src="{{ asset('images/success.png') }}">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection