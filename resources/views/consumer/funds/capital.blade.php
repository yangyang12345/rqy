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
                                {{--<div class="dataTables_length" id="example1_length">--}}
                                    {{--<label>Show--}}
                                        {{--<select name="example1_length" aria-controls="example1" class="form-control input-sm">--}}
                                            {{--<option value="10">10</option>--}}
                                            {{--<option value="25">25</option>--}}
                                            {{--<option value="50">50</option>--}}
                                            {{--<option value="100">100</option>--}}
                                        {{--</select> entries</label></div>--}}
                                <h4>本金账户：￥0.00元 　<a href="{{ url('/user/funds/capital') }}">明细</a>　　佣金账户：￥5.00元 　<a href="{{ url('/user/funds/brokerage') }}">明细</a></h4>
                            </div>
                            <div class="col-sm-12"><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="example1_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="capital" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="example1_info">
                                    {{--<thead>--}}
                                    {{--<tr role="row">--}}
                                        {{--<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"--}}
                                            {{--colspan="1" aria-sort="ascending"--}}
                                            {{--aria-label="Rendering engine: activate to sort column descending"--}}
                                            {{--style="width: 208px;">时间--}}
                                        {{--</th>--}}
                                        {{--<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"--}}
                                            {{--colspan="1" aria-label="Browser: activate to sort column ascending"--}}
                                            {{--style="width: 255px;">收/支--}}
                                        {{--</th>--}}
                                        {{--<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"--}}
                                            {{--colspan="1" aria-label="Platform(s): activate to sort column ascending"--}}
                                            {{--style="width: 227px;">内容--}}
                                        {{--</th>--}}
                                        {{--<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"--}}
                                            {{--colspan="1" aria-label="Engine version: activate to sort column ascending"--}}
                                            {{--style="width: 179px;">金额--}}
                                        {{--</th>--}}
                                        {{--<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"--}}
                                            {{--colspan="1" aria-label="CSS grade: activate to sort column ascending"--}}
                                            {{--style="width: 131px;">余额--}}
                                        {{--</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@foreach($capital as $c)--}}
                                        {{--<tr role="row" class="odd">--}}
                                            {{--<td>{{ $c->time }}</td>--}}
                                            {{--<td>{{ $c->time }}</td>--}}
                                            {{--<td>{{ $c->content }}</td>--}}
                                            {{--<td>{{ $c->quota }}</td>--}}
                                            {{--<td>{{ $c->banlance }}</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
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
        $dataTable = $("#dataTable");
        var table = $dataTable.DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "lengthMenu": [10, 25, 50, 75, 100, 200],
            "ajax": {
                "url": "{{ route('audit.getList') }}",
                "data": function (data) {
                    data.dynamic_type = "{{ Request::get('dynamic_type', 1) }}";
                    data.group_id = $("#group_id").val();
                    data.dynamic_id = $("#dynamic_id").val();
                    data.userid = $("#userid").val();
                    data.is_audit = $("#is_audit").val();
                    data.t = "{{ time() }}";
                }
            },
            "columns": [
                {"时间": "id"},
                {"收/支": "userid"},
                {"内容": "group_id"},
                {"金额": "dynamic_type"},
                {"余额": "dynamic_id"},
            ],
            "columnDefs": [
                {
                    "render": function (data, type, row) {
                        if (data == 1) {
                            return "活动";
                        } else if (data == 2) {
                            return "动态";
                        }
                    },
                    "targets": 3
                },
                {
                    "render": function (data, type, row) {
                        html = "";
                        $.each(data, function (k, v) {
                            html += "<a href='" + v.origin + "' target='_blank'><img src='" + v.origin + "' width='160' style='margin-bottom: 2px;'>";
                        });
                        return html;
                    },
                    "targets": 6
                },
                {
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return "未审核";
                        } else if (data == 1) {
                            return "审核通过";
                        } else if (data == -1) {
                            return "审核不通过";
                        }
                    },
                    "targets": 8
                },
                {
                    "render": function (data, type, row) {
                        if (row.is_audit == 0) {
                            return "<a class='btn btn-primary audit' data-type = 1>通过</a> <a class='btn btn-danger audit' data-type = 2>不通过</a>";
                        }
                        return "-";
                    },
                    "targets": 10
                }
            ],
            "createdRow": function (row, data, index) {
                $('td', row).eq(4).attr('style', 'word-break:break-all');
                $('td', row).eq(2).attr('style', 'word-break:break-all');
                $('td', row).eq(5).attr('style', 'word-break:break-all');
            },
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

        $dataTable.find('tbody').on('click', '.audit', function () {
            var data = table.row($(this).parents('tr')).data();
            var id = data.id;
            var userid = data.userid;
            var group_id = data.group_id;
            var dynamic_id = data.dynamic_id;
            var dynamic_type = data.dynamic_type;
            var type = $(this).data('type');
            audit(id, type, userid, group_id, dynamic_id, dynamic_type)
        });

        // 审核操作
        function audit(id, type, userid, group_id, dynamic_id, dynamic_type) {
            $.post("{{ route('audit.index') }}/" + id, {
                id: id,
                type: type,
                userid: userid,
                group_id: group_id,
                dynamic_id: dynamic_id,
                dynamic_type: dynamic_type,
                _token: "{{ csrf_token() }}",
                _method: "PUT"
            }, function (data) {
                if (data.result == 0) {
                    table.ajax.reload();
                    toastr.success("操作成功！");
                }
            });
        }

        $("#is_audit").select2({
            placeholder: "请选择状态",
            minimumResultsForSearch: Infinity
        });

        // 搜索
        $("#searchBtn").click(function(){
            table.draw();
        });
    </script>
    @endpush
@endsection

