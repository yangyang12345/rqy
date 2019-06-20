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
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h5 class="box-title">任务详情</h5>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th colspan="2">商品详情</th>
                            <th>
                                <label>商品单价：</label><span>{{ $task->goods_price }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label>每次拍几件：</label><span>{{ $task->goods_num }}</span>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <label>商品名称：</label><span>{{ $task->goods_name }}</span><br><br>
                                <label>商品链接地址：</label><a href="{{ $task->goods_url }}" target="_blank">{{ $task->goods_url }}</a><br><br>
                                <label>商品关键字：</label><span>{{ $task->goods_key }}</span><br>

                            </td>

                            <td>
                                <label>定位目标商品排序:</label>
                                @if($task->sort_style == 0)
                                <span>销量</span><br><br>
                                @elseif($task->sort_style == 1)
                                <span>综合</span><br><br>
                                @elseif($task->sort_style == 2)
                                <span>直通车</span><br><br>
                                @endif
                                <label>手机搜索页展示价格：</label><span>{{ $task->list_price }}</span><br><br>
                                <label>现有评价数：</label><span>{{ $task->receive_num }}</span><br>
                            </td>
                            <td>
                                <img width="300px" src="{{ asset($task->goods_pic) }}"><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            金额统计
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>商品单价</th>
                                            <th>每次拍几件</th>
                                            <th>订单数量</th>
                                            <th>每单手续费</th>
                                            <th>金额计算公式</th>
                                            <th>总价格</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $task->goods_price }}元</td>
                                            <td>{{ $task->goods_num }}个</td>
                                            <td>{{ $task->commen_num }}单</td>
                                            <td>2元</td>
                                            <td>({{ $task->goods_price }}x{{ $task->goods_num }}+2)x{{ $task->commen_num }}</td>
                                            <td><b>{{ ($task->goods_price*$task->goods_num+2)*$task->commen_num }}</b>元</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h3>选择支付方式</h3>
                    </div>
                    <div class="col-sm-8">
                        <h4>
                            <input type="radio" checked="checked"> 
                            使用账户余额支付 （可用余额 <span class="text-danger user_money">{{ $money->balance }}</span>元，<span class="text-danger">如余额不够，</span>
                            <a class="text-danger" href="{{ route('user.center') }}" target="_blank">可马上充值</a>，充值成功后请<a href="javascript:window.location.reload()" class="text-danger">请点我刷新</a>）
                        </h4>
                    </div>
                    <div class="col-sm-4 text-right">
                        <h4>支付 <span id="money" class="badge">{{ ($task->goods_price*$task->goods_num+2)*$task->commen_num }}</span>元</h4>
                    </div>
                    @if($task->status ==0)
                    <div class="col-sm-12">
                        <div class="hr-line-dashed"></div>
                        <div class="text-center">
                        <form method="post" action="{{ route('user.release_task.pay') }}">
                        @csrf
                            <input type="hidden" name="pay" value="{{ ($task->goods_price*$task->goods_num+2)*$task->commen_num }}">
                            <button type="submit" name="submit" class="btn btn-success btn-lg"">立即付款</button>
                        </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection