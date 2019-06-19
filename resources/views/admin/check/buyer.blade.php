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
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">买手审批</h3>
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
                                        <th>用户名称</th>
                                        <th>平台</th>
                                        <th>性别</th>
                                        <th>生日</th>
                                        <th>订单编号</th>
                                        <th>收货姓名</th>
                                        <th>收货电话</th>
                                        <th>审核状态</th>
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
<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="model_buyer" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ route('check.buyer.check') }}">
        @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                    买手账号审核确认
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <input name="buyer_id" class="buyer_id" type="hidden" value="">
                <div class="panel">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                买手详情
                            </a>
                        </h4>
                    </div>
                    <div id="goods_info" class="panel-collapse collapse in">
                        <div class="box-body">
                            <div class="invoice-col">
                                <label>账号所属平台：</label><strong class="platform"></strong><br>
                                <label>订单编号：</label><span class="serial"></span><br>
                                <label>收货姓名：</label><span class="receiver_name"></span><br>
                                <label>收货电话：</label><span class="receiver_tel"></span><br>
                            </div>
                        </div>
                    </div>
                    <p class="text-red">请仔细审核，审核无误后审批通过</p>
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
            "url": "{{ route('check.buyer.getList') }}",
            "type": "post",
            "data": function(data) {
                data._token = "{{csrf_token()}}"
                data.name = $('#name').val();
                data.status = $('#status').val();
            }
        },
        "columns": [{
                'data': 'name',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'platform',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'sex',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'Ymd',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'serial',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'receiver_name',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'receiver_tel',
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
        "columnDefs": [{
                "render": function(data, type, row) {
                    if (data == 0) {
                        return '<img src="{{ asset('images/t.png ') }}"><span>淘宝</span>'
                    } else if (data == 1) {
                        return '<img src="{{ asset('images/j.png ') }}"><span>京东</span>'
                    } else if (data == 2) {
                        return '<img src="{{ asset('images/p.png ') }}"><span>拼多多</span>'
                    }
                },
                "targets": 1
            },
            {
                "render": function(data, type, row) {
                    if (data == 0) {
                        return '保密'
                    } else if (data == 1) {
                        return '男士'
                    } else if (data == 2) {
                        return '女士'
                    }
                },
                "targets": 2
            },
            {
                "render": function (data, type, row) {
                    if (data == 0) {
                        return '<span><small class="label bg-yellow">审核中</small></span>';
                    } else if (data == 1) {
                        return '<span><small class="label bg-green">审核通过</small></span>';
                    } else if(data == 2){
                        return '<span><small class="label bg-red">审核未通过</small></span>'
                    }
                },
                "targets": 7
            },
            {
                "render": function(data, type, row) {
                    var value = JSON.stringify(row);
                    if (row.status == '0') {
                        return "<a onclick='confirm(" + value + ")' title='审核' class='fa fa-edit check'></a>"
                    }
                },
                "targets": 8
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

        $('#model_buyer').modal('toggle');

    }
</script>
@endpush
@endsection