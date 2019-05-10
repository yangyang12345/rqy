@extends('admin/base_template/dashboard')
@section('content')
    <div class="no-print margin-bottom">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> 注意事项：</h4>
            请认真确认相关信息，准确审核
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">充值审批</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> {{ $data->name }}
                        <small class="pull-right">注册时间:{{ $data->created_at }}</small>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    充值人
                    <address>
                        <strong>{{ $data->name }}</strong><br>
                        电话: {{ $data->tel }}<br>
                        qq: {{ $data->qq }}<br>
                        微信: {{ $data->wx }}<br>
                        邮箱: {{ $data->email }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>充值id:</b> {{ $data->id }}<br>
                    <b>充值时间:</b>{{ $data->ctime }}<br>
                    <b>转账银行/类型:</b> {{ $data->charge_type_name }}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>充值id</th>
                            <th>转账银行/类型</th>
                            <th>账号</th>
                            <th>账号名称</th>
                            <th>金额</th>
                            <th>充值时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->charge_type_name }}</td>
                            <td>{{ $data->account }}</td>
                            <td>{{ $data->account_name }}</td>
                            <td>{{ $data->fund }}</td>
                            <td>{{ $data->ctime }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">近期充值 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$265.24</td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
                <!-- /.col -->
            </div>

            <div class="row no-print">
                <div class="col-xs-12">
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-credit-card"></i> 充值成功
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
