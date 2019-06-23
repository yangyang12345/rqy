@extends('admin/base_template/dashboard')
@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">垫付任务订单管理</h3>
            </div>
            <div class="box-body">
                <div id="capital" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="box-tools pull-right form-inline">
                        <div class="form-group">
                            <input type="text" placeholder="启拉订单号" id="serial" name="serial" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="快递单号" id="alipay_order" name="alipay_order" value="" class="form-control">
                        </div>

                        <a class="btn btn-primary btn-sm" title="搜索" id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="capital_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="capital_table" style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>启拉订单号</th>
                                        <th>快递单号</th>
                                        <th>实际垫付金额</th>
                                        <th>状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="model_bank" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ route('check.advance_task.check') }}">
        @csrf
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
                    <input name="complete_id" class="complete_id" type="hidden" value="">
                    <p class="text-red">请仔细确认，确认后平台将返款</p>
                    <div class="panel">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                    订单详情
                                </a>
                            </h4>
                        </div>
                        <div id="goods_info" class="panel-collapse collapse in">
                            <div class="box-body">
                                <div class="invoice-col">
                                    <label>启拉订单号：</label><strong class="serial"></strong><br>
                                    <label>物流快递单号：</label><span class="alipay_order"></span><br>
                                    <label>实际垫付费用：</label><span class="fee"></span><br>
                                    <label>支付凭证：</label><br><img width="400px" src="" class="pic">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <!-- <button type="submit" name="submit" value="nopass" class="btn btn-danger">审批不通过</button> -->
                    <button type="submit" name="submit" value="pass" class="btn btn-primary">订单完成</button>
                </div>
            </div>
        </div>
    </form>

</div>

@push('datatable-js')
<script type="text/javascript">
    $dataTable = $("#capital_table");
    var table = $dataTable.DataTable({
        "ordering": false, //排序 关闭
        "searching": false, //是否显示搜索框，
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "lengthMenu": [10, 25, 50, 75, 100, 200],
        "ajax": {
            "url": "{{ route('advance_task.getList') }}",
            "type": "post",
            "data": function(data) {
                data.alipay_order = $('#alipay_order').val();
                data.serial = $('#serial').val();
                data._token = "{{csrf_token()}}"
            }
        },
        "columns": [{
                'data': 'serial',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'alipay_order',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'fee',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'status',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'ctime',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': '',
                "defaultContent": " ",
                'className': ''
            },
        ],
        "columnDefs": [{
                "render": function(data, type, row) {
                    if (data == 0) {
                        return '<span><small class="label bg-yellow">待确认</small></span>';
                    } else if (data == 1) {
                        return '<span><small class="label bg-green">确认通过，订单完成</small></span>';
                    }
                },
                "targets": 3
            },
            {
                "render": function(data, type, row) {
                    var value = JSON.stringify(row);
                    if (row.status == '0') {
                        return "<a onclick='confirm(" + value + ")' title='审核' class='fa fa-edit check'></a>"
                    }
                },
                "targets": 5
            },
        ],
        "language": {
            processing: "数据加载中...",
            info: "显示第 _START_ 至 _END_ 条，共 _TOTAL_ 条记录",
            infoEmpty: "暂无数据",
            lengthMenu: "显示 _MENU_ 条记录",
            paginate: {
                first: "首页",
                previous: "上一页",
                next: "下一页",
                last: "最后一页"
            }
        }
    });

    $('#btn_search').click(function() {
        table.draw();
    });

    function confirm(row) {
        $(".serial").text(row.serial);
        $(".alipay_order").text(row.alipay_order);
        $(".fee").text(row.fee);
        $(".pic").attr("src", 'data:image/jpg;base64,' + row.pic);
        $(".complete_id").val(row.id);
        $('#model_bank').modal('toggle');
    }
</script>
@endpush
@endsection