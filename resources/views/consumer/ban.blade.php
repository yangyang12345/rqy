@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header"><h5 class="box-title">黑名单</h5></div>
                <div class="box-body">
                    <div id="ban" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="ban_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="ban_table" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>用户名</th>
                                        <th>到期释放</th>
                                        <th>类型及原因</th>
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
            $dataTable = $("#ban_table");
            var table = $dataTable.DataTable({
                "ordering": false,//排序 关闭
                "searching": false,//是否显示搜索框，
                "processing": true,
                "serverSide": true,
                "pageLength": 6,
                "lengthMenu": [6, 10, 15],
                "ajax": {
                    "url": "{{ route('ban.getList') }}",
                    "type":"post",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {'data':'ban_id',"defaultContent": " ",'className':''},
                    {'data':'time_to_free',"defaultContent": " ",'className':''},
                    {'data':'type',"defaultContent": " ",'className':''},
                    {'data':'',"defaultContent": " ",'className':''},
                ],
                // "columnDefs": [
                //     {
                //         "render": function (data, type, row) {
                //             if (data == 0) {
                //                 return '<span><small class="label bg-primary">浏览错商品或店铺</small></span>';
                //             } else if (data == 1) {
                //                 return '<span><small class="label bg-primary">问题任务</small></span>';
                //             } else if(data == 2){
                //                 return '<span><small class="label bg-primary">用户做任务问题</small></span>'
                //             } else if(data == 3){
                //                 return '<span><small class="label bg-primary">用户确认收货，好评问题</small></span>'
                //             } else if(data == 4){
                //                 return '<span><small class="label bg-primary">淘宝客/村淘投诉</small></span>'
                //             } else if(data == 5){
                //                 return '<span><small class="label bg-primary">其它</small></span>'
                //             }
                //         },
                //         "targets": 1
                //     },
                //     {
                //         "render": function (data, type, row) {
                //             if (data == 0) {
                //                 return '<span><small class="label bg-yellow">处理中</small></span>';
                //             } else if (data == 1) {
                //                 return '<span><small class="label bg-green">已完结</small></span>';
                //             } else if(data == 2){
                //                 return '<span><small class="label bg-red">系统完结</small></span>'
                //             }
                //         },
                //         "targets": 4
                //     },
                // ],
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
        </script>
    @endpush
@endsection