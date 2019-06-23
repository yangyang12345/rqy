@extends('admin/base_template/dashboard')
@section('content')
    @if(!empty(session('success')))
        　　<div class="alert alert-success" role="alert">
            　　　　{{session('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header">
                    <span class="label label-primary pull-right">本金余额{{ $capital->balance?$capital->balance:0 }}</span>
                    <h3 class="box-title">本金充值</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <!-- <li class="active"><a href="#tab_card" data-toggle="tab" aria-expanded="true">银行卡充值</a></li> -->
                                    <li class=""><a href="#tab_online" data-toggle="tab" aria-expanded="false">支付宝充值</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!-- <div class="tab-pane active" id="tab_card">
                                        <div class="col-md-12">
                                            <ul class="timeline">
                                                <li class="time-label">
                                                    <span class="bg-green">{{ date('Y-m-d',time()) }}</span>
                                                </li>
                                                <li>
                                                    <i class="fa bg-blue">1</i>

                                                    <div class="timeline-item">
                                                        <h3 class="timeline-header">转账到启拉官方指定收款账号</h3>

                                                        <div class="timeline-body">
                                                            <p>
                                                                转账途径　电脑网银、手机银行 注意：请勿通过其他途径转账<br>
                                                                收款户名　晏建辉<br>
                                                                收款账号　6217 9065 0002 9719 927<br>
                                                                收款银行　中国银行<br>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa bg-aqua">2</i>

                                                    <div class="timeline-item">

                                                        <h3 class="timeline-header no-border">提交转账信息</h3>
                                                        <div class="timeline-body">
                                                            <p>
                                                                转账至人气云指定账号后，点击下方按钮提交转账信息
                                                            </p>
                                                            <button class="btn btn-info btn-lg" id="model_card">提交转帐信息</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa bg-yellow">3</i>

                                                    <div class="timeline-item">

                                                        <h3 class="timeline-header">人工审核</h3>

                                                        <div class="timeline-body">
                                                            <p>充值客服工作时间每日09:00-22:00，审核人员每15钟会审核一次，查询到账即能通过审核，22:00以后的银行卡转账充值将无人审核，会到第二个工作日处理</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-clock-o bg-gray"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <div class="tab-pane active" id="tab_online">
                                        <div class="col-md-12">
                                            <ul class="timeline">
                                                <li class="time-label">
                                                    <span class="bg-green">{{ date('Y-m-d',time()) }}</span>
                                                </li>
                                                <li>
                                                    <i class="fa bg-blue">1</i>

                                                    <div class="timeline-item">
                                                        <h3 class="timeline-header">扫码启拉官方指定二维码</h3>

                                                        <div class="timeline-body">
                                                            <img src="{{ asset('/images/sk1.jpeg') }}" width="200/">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa bg-aqua">2</i>

                                                    <div class="timeline-item">

                                                        <h3 class="timeline-header no-border">提交转账信息</h3>
                                                        <div class="timeline-body">
                                                            <p>
                                                                转账至人气云指定账号后，点击下方按钮提交转账信息
                                                            </p>
                                                            <button class="btn btn-info btn-lg" id="model_online">提交转帐信息</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa bg-yellow">3</i>

                                                    <div class="timeline-item">

                                                        <h3 class="timeline-header">人工审核</h3>

                                                        <div class="timeline-body">
                                                            <p>充值客服工作时间每日09:00-22:00，审核人员每15钟会审核一次，查询到账即能通过审核，22:00以后的银行卡转账充值将无人审核，会到第二个工作日处理</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-clock-o bg-gray"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <div class="panel panel-default" style="height:100%;">
                                <div class="panel-heading"> 充值注意事项
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>银行卡充值禁止通过银行柜台、ATM机转账</td>
                                        </tr>
                                        <tr>
                                            <td>要求先转账再提交转账信息,为了方便财务确认并及时充值，务必转账时带个零头，如500.08或1000.18</td>
                                        </tr>
                                        <tr>
                                            <td>转账时仔细核对收款人姓名和帐号</td>
                                        </tr>
                                        <tr>
                                            <td>提交转账信息前仔细核对转账金额和本人姓名及帐号，禁止重复提交转账信息如发现恶意重复提交，将罚款甚至封号</td>
                                        </tr>
                                        <tr>
                                            <td>及时提交转账信息，未及时提交者（超过一天）联系在线客服说明充值时间</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">最近5条充值记录</h3>
                    <div class="box-tools">
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>提交时间</th>
                            <th>转账银行/类型</th>
                            <th>开户名/账号</th>
                            <th>金额</th>
                            <th>审核状态</th>
                            <th>审核时间</th>
                        </tr>
                        @foreach($charges as $charge)
                            <tr role="row" class="odd">
                                <td>{{ $charge->ctime }}</td>
                                <td>@include('consumer/charge/type')</td>
                                <td>{{ $charge->account_name }}</td>
                                <td>{{ $charge->fund }}</td>
                                <td>@include('consumer/charge/status')</td>
                                <td>{{ $charge->vtime }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modal_card" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('charge.bank',['id'=>Auth::id()]) }}">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                        银行
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">我的账户信息</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <select id="bank_type" name="bank_type" class="form-control m-b" required="">
                                            <option value="0">请选择转账银行</option>
                                            <option value="1">中国建设银行</option>
                                            <option value="2">中国工商银行</option>
                                            <option value="3">中国农业银行</option>
                                            <option value="4">中国银行</option>
                                            <option value="5">中国邮政储蓄银行</option>
                                            <option value="6">招商银行</option>
                                            <option value="7">平安银行</option>
                                            <option value="8">民生银行</option>
                                            <option value="9">交通银行</option>
                                            <option value="10">光大银行</option>
                                            <option value="11">中信银行</option>
                                            <option value="12">广发银行</option>
                                            <option value="13">兴业银行</option>
                                            <option value="14">上海浦东发展银行</option>
                                            <option value="49">其他银行</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group has-success">
                                    <div class="col-xs-12">
                                        <input id="bank_code" name="bank_code" type="text" class="form-control" placeholder="转出银行卡号" maxlength="19" pattern="^[0-9]{12,19}$" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group has-success">
                                    <div class="col-xs-12">
                                        <input id="true_name" name="true_name" type="text" class="form-control" placeholder="转出银行卡姓名[如选的其他银行,在姓名后备注银行名]" maxlength="20"  required="">
                                        <span class="help-block m-b-none">填写你转出银行卡开户账号的姓名，方便财务核对，不要填手机号，<font class="badge">如选的其他银行,在姓名后备注银行名</font></span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group has-success">
                                    <div class="col-xs-12">
                                        <input id="money" name="money" type="number" class="form-control" placeholder="转账金额（元）" min="1" step="0.01" required="">
                                        <span class="help-block m-b-none">（充值1次提交1次即可，恶意反复提交将处罚或封号）</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            请认真仔细填写相关资料
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="Modal_online" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('charge.online',['id'=>Auth::id()]) }}">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                        我的账号信息
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">支付宝</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                     <input type="hidden" name="online_type" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group has-success">
                                    <div class="col-xs-12">
                                        <input id="online_code" name="online_code" type="text" class="form-control" placeholder="转账账号" maxlength="19"  required="">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row"><div class="form-group has-success">
                                    <div class="col-xs-12">
                                        <input id="nick_name" name="nick_name" type="text" class="form-control" placeholder="转帐昵称" maxlength="20"  required="">
                                    </div>
                                </div></div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group has-success">
                                    <div class="col-xs-12">
                                        <input id="online_money" name="online_money" type="number" class="form-control" placeholder="转账金额（元）" min="1" step="0.01" required="">
                                        <span class="help-block m-b-none">（充值1次提交1次即可，恶意反复提交将处罚或封号）</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            请认真仔细填写相关资料
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection