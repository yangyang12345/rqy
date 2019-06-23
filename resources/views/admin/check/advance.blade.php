@extends('admin/base_template/dashboard')
@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">提现审批</h3>
                <div class="box-tools form-inline">
                    <div class="form-group">
                        <input type="text" placeholder="用户名称" id="name" name="name" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="status" name="status">
                            <option value="99">状态</option>
                            <option value="0">审核中</option>
                            <option value="1">审核通过</option>
                            <option value="2">审核未通过</option>
                        </select>
                    </div>

                    <a class="btn btn-primary btn-sm" title='搜索' id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>

                </div>
            </div>
            <div class="box-body">
                <div id="capital" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="shop_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="shop_table" style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>提现流水</th>
                                        <th>账号</th>
                                        <th>银行卡</th>
                                        <th>提现金额</th>
                                        <th>状态</th>
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
<div class="modal fade" id="model_advance" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ route('check.advance.check') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                        提现转账确认
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <input name="advance_id" class="advance_id" type="hidden" value="">
                    <div class="panel">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                    提现详情
                                </a>
                            </h4>
                        </div>
                        <div id="goods_info" class="panel-collapse collapse in">
                            <div class="box-body">
                                <div class="invoice-col">
                                    <label>账号：</label><strong class="name"></strong><br>
                                    <label>银行卡</label><span class="card"></span><br>
                                    <label>提现金额</label><span class="receiver_name"></span><br>
                                </div>
                            </div>
                        </div>
                        <p class="text-red">请仔细审核，确认后转账后点击审批通过</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" name="submit" value="nopass" class="btn btn-danger">审批不通过</button>
                    <button type="submit" name="submit" value="pass" class="btn btn-primary">审批通过</button>
                </div>
            </div>
        </div>
    </form>

</div>
@push('datatable-js')
<script type="text/javascript">
    $dataTable = $("#shop_table");
    var table = $dataTable.DataTable({
        "ordering": false, //排序 关闭
        "searching": false, //是否显示搜索框，
        "processing": true,
        "serverSide": true,
        "pageLength": 15,
        "lengthMenu": [15, 20, 25, 30],
        "ajax": {
            "url": "{{ route('check.advance.getList') }}",
            "type": "post",
            "data": function(data) {
                data._token = "{{csrf_token()}}"
                data.name = $('#name').val();
                data.status = $('#status').val();
            }
        },
        "columns": [{
                'data': 'serial',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'name',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'card',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'balance',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'status',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': '',
                "defaultContent": " ",
                'className': ''
            },
        ],
        "columnDefs": [

            {
                "render": function(data, type, row) {
                    if (data == 0) {
                        return '<span><small class="label bg-yellow">审核中</small></span>';
                    } else if (data == 1) {
                        return '<span><small class="label bg-green">审核通过</small></span>';
                    } else if (data == 2) {
                        return '<span><small class="label bg-red">审核未通过</small></span>'
                    }
                },
                "targets": 4
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

        if (row.platform == 0) {
            $(".platform").text('淘宝');
        } else if (row.platform == 1) {
            $(".platform").text('京东');
        } else if (row.platform == 2) {
            $(".platform").text('拼多多');
        }
        $(".serial").text(row.serial);
        $(".receiver_name").text(row.receiver_name);
        $(".receiver_tel").text(row.receiver_tel);
        $(".buyer_id").val(row.id);

        $('#model_advance').modal('toggle');

    }
</script>
@endpush
@endsection