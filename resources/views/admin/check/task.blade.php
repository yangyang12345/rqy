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
                <h3 class="box-title">任务审批</h3>
                <div class="box-tools form-inline">
                    <div class="form-group">
                        <input type="text" placeholder="流水号" id="serial" name="serial" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="status" name="status">
                            <option value="99">状态</option>
                            <option value="2">已付款，待审核</option>
                            <option value="3">审核失败</option>
                            <option value="4">审核通过，已发布</option>
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
                                        <th>流水号</th>
                                        <th>关键字</th>
                                        <th>任务类型</th>
                                        <th>平台</th>
                                        <th>审核状态</th>
                                        <th>订单时间</th>
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

<div class="modal fade" id="model_task" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ route('check.task.check') }}">
        @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                    任务审核确认
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <input name="task_id" class="task_id" type="hidden" value="">
                <div class="panel">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                任务详情
                            </a>
                        </h4>
                    </div>
                    <div id="goods_info" class="panel-collapse collapse in">
                        <div class="box-body">
                            <div class="invoice-col">
                                <label>任务所属平台：</label><strong class="platform"></strong><br>
                                <label>任务编号：</label><span class="serial"></span><br>
                                <label>任务单数：</label><span class="commen_num"></span><br>
                                <label>任务类型：</label><span class="task_name"></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                商品详情
                            </a>
                        </h4>
                    </div>
                    <div id="goods_info" class="panel-collapse collapse in">
                        <div class="box-body">
                            <div class="invoice-col">
                                <label>商品名称：</label><strong class="goods_name"></strong><br>
                                <label>关键字：</label><span class="goods_key"></span><br>
                                <label>搜索关键字：</label><span class="commen_keywords"></span><br>
                                <label>商品链接：</label><a href="" class="goods_url"></a><br>
                                <label>商品图片：</label><img width="400px" src="" class="goods_pic" /><br>
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
            "url": "{{ route('check.task.getList') }}",
            "type": "post",
            "data": function(data) {
                data._token = "{{csrf_token()}}"
                data.serial = $('#serial').val();
                data.status = $('#status').val();
            }
        },
        "columns": [{
                'data': 'serial',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'goods_key',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'task_name',
                "defaultContent": " ",
                'className': ''
            },
            {
                'data': 'platform',
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
                        return '<img src="{{ asset('images/t.png ') }}"><span>淘宝</span>'
                    } else if (data == 1) {
                        return '<img src="{{ asset('images/j.png ') }}"><span>京东</span>'
                    } else if (data == 2) {
                        return '<img src="{{ asset('images/p.png ') }}"><span>拼多多</span>'
                    }
                },
                "targets": 3
            },
            {
                "render": function (data, type, row) {
                    if (data == 2) {
                        return '<span><small class="label bg-yellow">已付款，待审核</small></span>';
                    } else if (data == 3) {
                        return '<span><small class="label bg-red">审核失败</small></span>';
                    } else if(data == 4){
                        return '<span><small class="label bg-green">审核通过，已发布</small></span>'
                    }
                },
                "targets": 4
            },
            {
                "render": function(data, type, row) {
                    var value = JSON.stringify(row);
                    if (row.status == '2') {
                        return "<a onclick='confirm(" + value + ")' title='审核' class='fa fa-edit check'></a>"
                    }
                },
                "targets": 6
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
        $(".commen_num").text(row.commen_num);
        $(".commen_keywords").text(row.commen_keywords);
        $(".task_name").text(row.task_name);
        $(".goods_name").text(row.goods_name);
        $(".goods_key").text(row.goods_key);
        $(".goods_url").text(row.goods_url);
        $(".goods_url").attr("href",row.goods_url);
        $(".goods_pic").attr("src",row.goods_pic);
        $(".task_id").val(row.id);

        $('#model_task').modal('toggle');

    }
</script>
@endpush
@endsection