@extends('admin/base_template/dashboard')
@section('content')
    @if(!empty(session('success')))
        　　<div class="alert alert-success" role="alert">
            　　　　{{session('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">申述中心</h3>
                    <a href="{{ url('/user/explain/push') }}" class="btn btn-info btn-xs pull-right" id="bind-shop">发起申述</a>
                </div>
                <div class="box-body">
                    <div id="explain" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="box-tools pull-right form-inline">
                            <div class="form-group">
                                <select class="form-control" id="uid_type" name="uid_type">
                                    <option value="99">类型</option>
                                    <option value="1">我发起的申诉</option>
                                    <option value="2">我收到的申诉</option>
                                </select>
                                <select class="form-control" id="status" name="status">
                                    <option value="99">申诉状态</option>
                                    <option value="0">处理中 </option>
                                    <option value="1">已完结</option>
                                    <option value="2">系统完结</option>
                                </select>
                                <input type="text" placeholder="任务ID" id="tid" name="tid" value="" class="form-control">
                                <input type="text" placeholder="订单ID" id="oid" name="oid" value="" class="form-control">
                            </div>

                            <a class="btn btn-primary btn-sm" title="搜索" id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="explain_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="explain_table" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>发起时间</th>
                                        <th>投诉类型</th>
                                        <th>任务ID</th>
                                        <th>订单及用户信息</th>
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
    @push('datatable-js')
        <script type="text/javascript">
            $dataTable = $("#explain_table");
            var table = $dataTable.DataTable({
                "ordering": false,//排序 关闭
                "searching": false,//是否显示搜索框，
                "processing": true,
                "serverSide": true,
                "pageLength": 6,
                "lengthMenu": [6, 10, 15],
                "ajax": {
                    "url": "{{ route('explain.getList') }}",
                    "type":"post",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {'data':'ctime',"defaultContent": " ",'className':''},
                    {'data':'explain_type',"defaultContent": " ",'className':''},
                    {'data':'order_id',"defaultContent": " ",'className':''},
                    {'data':'order_id',"defaultContent": " ",'className':''},
                    {'data':'status',"defaultContent": " ",'className':''},
                    {'data':'',"defaultContent": " ",'className':''},
                ],
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            if (data == 0) {
                                return '<span><small class="label bg-primary">浏览错商品或店铺</small></span>';
                            } else if (data == 1) {
                                return '<span><small class="label bg-primary">问题任务</small></span>';
                            } else if(data == 2){
                                return '<span><small class="label bg-primary">用户做任务问题</small></span>'
                            } else if(data == 3){
                                return '<span><small class="label bg-primary">用户确认收货，好评问题</small></span>'
                            } else if(data == 4){
                                return '<span><small class="label bg-primary">淘宝客/村淘投诉</small></span>'
                            } else if(data == 5){
                                return '<span><small class="label bg-primary">其它</small></span>'
                            }
                        },
                        "targets": 1
                    },
                    {
                        "render": function (data, type, row) {
                            if (data == 0) {
                                return '<span><small class="label bg-yellow">处理中</small></span>';
                            } else if (data == 1) {
                                return '<span><small class="label bg-green">已完结</small></span>';
                            } else if(data == 2){
                                return '<span><small class="label bg-red">系统完结</small></span>'
                            }
                        },
                        "targets": 4
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

            $('#btn_search').click(function () {
                table.draw();
            });
        </script>
    @endpush
@endsection