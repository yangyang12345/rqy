@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">店铺审批</h3>
                    <div class="box-tools form-inline">
                        <div class="form-group">
                            <input type="text" placeholder="转账银行/类型" id="charge_type_name" name="charge_type_name" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="账号" id="account" name="account" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="账号名称" id="account_name" name="account_name" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="status" name="status">
                                <option value="99">状态</option>
                                <option value="0">审核中</option>
                                <option value="1">审核通过</option>
                                <option value="2">失败</option>
                            </select>
                        </div>

                        <a class="btn btn-primary btn-sm" title='搜索' id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>

                    </div>
                </div>
                <div class="box-body">
                    <div id="capital" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="fund_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="fund_table">
                                    <thead>
                                    <tr role="row">
                                        <th>用户</th>
                                        <th>店铺类型</th>
                                        <th>店铺名</th>
                                        <th>店铺链接</th>
                                        <th>发货地址</th>
                                        <th>电话</th>
                                        <th>时间</th>
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
            $dataTable = $("#fund_table");
            var table = $dataTable.DataTable({
                "ordering": false,//排序 关闭
                "searching": false,//是否显示搜索框，
                "processing": true,
                "serverSide": true,
                "pageLength": 15,
                "lengthMenu": [15, 20, 25, 30],
                "ajax": {
                    "url": "{{ route('check.shop.getList') }}",
                    "type":"post",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}"
                        data.charge_type_name = $('#charge_type_name').val();
                        data.account = $('#account').val();
                        data.account_name = $('#account_name').val();
                        data.status = $('#status').val();
                    }
                },
                "columns": [
                    {'data':'user_id',"defaultContent": " ",'className':''},
                    {'data':'type',"defaultContent": " ",'className':''},
                    {'data':'name',"defaultContent": " ",'className':''},
                    {'data':'url',"defaultContent": " ",'className':''},
                    {'data':'address',"defaultContent": " ",'className':''},
                    {'data':'status',"defaultContent": " ",'className':''},
                    {'data':'ctime',"defaultContent": " ",'className':''},
                    {'data':'',"defaultContent": " ",'className':''},
                ],
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            if (data == 0) {
                                return '<span><small class="label bg-yellow">审核中</small></span>';
                            } else if (data == 1) {
                                return '<span><small class="label bg-green">审核通过</small></span>';
                            } else if(data == 2){
                                return '<span><small class="label bg-red">失败</small></span>'
                            }
                        },
                        "targets": 5
                    },
                    {
                        "render": function (data, type, row) {
                            if (row.status == '0'){
                                return '<a href="#" title="审核" class="fa fa-edit check"></a>'
                            }
                        },
                        "targets": 7
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
