@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">本金账户明细</h3>
                    <button class="btn btn-info btn-xs pull-right">佣金转本金</button>
                </div>
                <div class="box-body">
                    <div id="capital" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>本金账户：
                                    ￥{{ $capital->balance?$capital->balance:0 }}元 　
                                    <a href="{{ url('/user/funds/capital') }}">明细</a>　　
                                    佣金账户：￥{{ $brokerage->balance?$brokerage->balance:0 }}元 　
                                    <a href="{{ url('/user/funds/brokerage') }}">明细</a>
                                </h4>
                            </div>
                            <div class="col-sm-12"><hr></div>
                        </div>
                        <div class="box-tools pull-right form-inline">
                            <div class="form-group">
                                <select class="form-control" id="type" name="type">
                                    <option value="99">筛选类型</option>
                                    <option value="0">本金充值</option>
                                    <option value="1">发布任务</option>
                                    <option value="2">撤销任务退款</option>
                                    <option value="3">佣金转本金</option>
                                </select>
                            </div>

                            <a class="btn btn-primary btn-sm" title="搜索" id="btn_search" href="javascript:void(0)"><i class="fa fa-search"></i>搜索</a>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="capital_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="capital_table" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>时间</th>
                                        <th>收/支</th>
                                        <th>内容</th>
                                        <th>金额（单位：元）</th>
                                        <th>余额（单位：元）</th>
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
        $dataTable = $("#capital_table");
        var table = $dataTable.DataTable({
            "ordering": false,//排序 关闭
            "searching": false,//是否显示搜索框，
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "lengthMenu": [10, 25, 50, 75, 100, 200],
            "ajax": {
                "url": "{{ route('capital.getList') }}",
                "type":"post",
                "data": function (data) {
                    data.type = $('#type').val();
                    data._token = "{{csrf_token()}}"
                }
            },
            "columns": [
                {'data':'ctime',"defaultContent": " ",'className':''},
                {'data':'in_out',"defaultContent": " ",'className':''},
                {'data':'content',"defaultContent": " ",'className':''},
                {'data':'quota',"defaultContent": " ",'className':''},
                {'data':'balance',"defaultContent": " ",'className':''},
            ],
            "columnDefs": [
                {
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return "收";
                        } else if (data == 1) {
                            return "支";
                        }
                    },
                    "targets": 1
                },
                {
                    "render": function (data, type, row) {
                        if (row.in_out == 0) {
                            return "+"+data;
                        } else if (row.in_out == 1) {
                            return "-"+data;
                        }
                    },
                    "targets": 3
                }
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

