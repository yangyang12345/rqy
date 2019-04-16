@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header">
                    <span class="label label-primary pull-right">本金余额0.00</span>
                    <h3 class="box-title">本金充值</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">银行卡充值</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">微信/支付宝充值</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-md-12">
                                            <ul class="timeline">
                                                <li class="time-label">
                                                    <span class="bg-green">{{ date('Y-m-d',time()) }}</span>
                                                </li>
                                                <li>
                                                    <i class="fa bg-blue">1</i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                                        <div class="timeline-body">
                                                            转账到启拉官方指定收款账号<br>
                                                            转账途径　电脑网银、手机银行 注意：请勿通过其他途径转账<br>
                                                            收款户名　黄耀莲<br>
                                                            收款账号　6222 0320 1001 2054 735<br>
                                                            收款银行　中国工商银行(虎门支行)<br>
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a class="btn btn-primary btn-xs">Read more</a>
                                                            <a class="btn btn-danger btn-xs">Delete</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa bg-aqua">2</i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa bg-yellow">3</i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                                        <div class="timeline-body">
                                                            Take me to your leader!
                                                            Switzerland is small and neutral!
                                                            We are more like Germany, ambitious and misunderstood!
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-clock-o bg-gray"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        The European languages are members of the same family. Their separate existence is a myth.
                                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                        new common language would be desirable: one could refuse to pay expensive translators. To
                                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                        words. If several languages coalesce, the grammar of the resulting language is more simple
                                        and regular than that of the individual languages.
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
@endsection