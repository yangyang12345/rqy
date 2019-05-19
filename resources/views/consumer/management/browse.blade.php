@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">浏览任务管理</h3>
                </div>
                <div class="box-body">
                    <div id="browse" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="browse_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="browse_table" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>流水号</th>
                                        <th>商品名称</th>
                                        <th>商品图片</th>
                                        <th>商家信息</th>
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
    @push('datatable-js')
        <script type="text/javascript">
            $dataTable = $("#browse_table");
            var table = $dataTable.DataTable({
                "ordering": false,//排序 关闭
                "searching": false,//是否显示搜索框，
                "processing": true,
                "serverSide": true,
                "pageLength": 6,
                "lengthMenu": [6, 10, 15],
                "ajax": {
                    "url": "{{ route('browse.getList') }}",
                    "type":"post",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {'data':'serial',"defaultContent": " ",'className':''},
                    {'data':'goods_name',"defaultContent": " ",'className':''},
                    {'data':'goods_pic',"defaultContent": " ",'className':''},
                    {'data':'shop_id',"defaultContent": " ",'className':''},
                    {'data':'ctime',"defaultContent": " ",'className':''},
                    {'data':'',"defaultContent": " ",'className':''},
                ],
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            return '<img width="50" height="50" src="'+data+'">'
                        },
                        "targets": 2
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