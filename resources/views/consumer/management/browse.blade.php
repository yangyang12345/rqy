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
                    <h3 class="box-title">垫付任务管理</h3>
                    <div class="box-tools form-inline">
                    <div class="form-group">
                        <input type="text" placeholder="商品名" id="name" name="name" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="流水号" id="serial" name="serial" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="status" name="status">
                            <option value="99">状态</option>
                            <option value="0">未付款</option>
                            <option value="1">已取消</option>
                            <option value="2">已付款，待审核</option>
                            <option value="3">审核失败</option>
                            <option value="4">审核通过，已发布</option>
                        </select>
                    </div>

                    <a class="btn btn-primary btn-sm" title='搜索' id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>

                </div>
                </div>
                <div class="box-body">
                    <div id="advance" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="advance_tab" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="advance_tab" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>流水号</th>
                                        <th>商品名称</th>
                                        <th>关键字</th>
                                        <th>订单数据</th>
                                        <th>任务状态</th>
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
            $dataTable = $("#advance_tab");
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
                        data.name = $('#name').val();
                        data.status = $('#status').val();
                        data.serial = $('#serial').val();
                    }
                },
                "columns": [
                    {'data':'serial',"defaultContent": " ",'className':''},
                    {'data':'goods_name',"defaultContent": " ",'className':''},
                    {'data':'goods_key',"defaultContent": " ",'className':''},
                    {'data':'commen_num',"defaultContent": " ",'className':''},
                    {'data':'status',"defaultContent": " ",'className':''},
                    {'data':'ctime',"defaultContent": " ",'className':''},
                    {'data':'',"defaultContent": " ",'className':''},
                ],
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            return '<span>共'+data+'单</span>'
                        },
                        "targets": 3
                    },
                    {
                        "render": function (data, type, row) {
                            if (data == 0) {
                                return '<span><small class="label bg-red">未付款</small></span>';
                            } else if (data == 1) {
                                return '<span><small class="label bg-yellow">已取消</small></span>';
                            } else if(data == 2){
                                return '<span><small class="label bg-green">已付款，待审核</small></span>'
                            } else if(data == 3){
                                return '<span><small class="label bg-red">审核失败</small></span>'
                            } else if(data == 4){
                                return '<span><small class="label bg-green">审核通过，已发布</small></span>'
                            }
                        },
                        "targets": 4
                    },
                    {
                        "render": function(data, type, row) {
                            var html = ''

                            html += '<a title="查看详情" onclick="basic_info('+row.id+')" class="fa fa-eye"></a>&nbsp;&nbsp;';

                            if (row.status == 0){
                                html += '<a title="取消任务" href="{{ route("user.release_task.delete") }}?id='+row.id+'" class="fa fa-trash"></a>'
                            }
                                    
                            return html;
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

            $('#btn_search').click(function () {
                table.draw();
            });

            function basic_info(id){
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.release_task.id') }}?_token={{csrf_token()}}",
                    data: {id:id},
                    success: function(data){
                        window.location.href="{{ route('user.release_task.info') }}?id="+data.id+"&wrap_type=1"; 
                    }
                });
            }
        </script>
    @endpush
@endsection