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
                    <h3 class="box-title">银行卡审批</h3>
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
                                <table id="shop_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="shop_table" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>持卡人姓名</th>
                                        <th>卡号</th>
                                        <th>开户银行</th>
                                        <th>银行卡照片</th>
                                        <th>审核状态</th>
                                        <th>时间</th>
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

    <div class="modal fade" id="model_bank" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="{{ route('check.bank.check') }}">
        @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                    银行账号审核确认
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <input name="bank_id" class="bank_id" type="hidden" value="">
                <div class="panel">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#goods_info">
                                银行卡详情
                            </a>
                        </h4>
                    </div>
                    <div id="goods_info" class="panel-collapse collapse in">
                        <div class="box-body">
                            <div class="invoice-col">
                                <label>银行卡账号：</label><strong class="card"></strong><br>
                                <label>所属分行：</label><span class="deposit"></span><br>
                                <label>持卡人姓名</label><span class="name"></span><br>
                                <label>照片：</label><br><img width="400px" src="" class="pic_bank">
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
                "ordering": false,//排序 关闭
                "searching": false,//是否显示搜索框，
                "processing": true,
                "serverSide": true,
                "pageLength": 15,
                "lengthMenu": [15, 20, 25, 30],
                "ajax": {
                    "url": "{{ route('check.bank.getList') }}",
                    "type":"post",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}"
                        data.name = $('#name').val();
                        data.status = $('#status').val();
                    }
                },
                "columns": [
                    {'data':'name',"defaultContent": " ",'className':''},
                    {'data':'card',"defaultContent": " ",'className':''},
                    {'data':'deposit',"defaultContent": " ",'className':''},
                    {'data':'pic_bank',"defaultContent": " ",'className':''},
                    {'data':'status',"defaultContent": " ",'className':''},
                    {'data':'ctime',"defaultContent": " ",'className':''},
                    {'data':'',"defaultContent": " ",'className':''},
                ],
                "columnDefs": [
                   
                    {
                        "render": function (data, type, row) {
                            return '<img width="50" height="50" src="data:image/jpg;base64,'+data+'">'
                        },
                        "targets": 3
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
                        "targets": 4
                    },
                    {
                        "render": function (data, type, row) {
                            var value = JSON.stringify(row);
                            if (row.status == '0'){
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

            $('#btn_search').click(function () {
                table.draw();
            });

            function confirm(row) {
                $(".card").text(row.card);
                $(".deposit").text(row.deposit);
                $(".name").text(row.name);
                $(".pic_bank").attr("src",'data:image/jpg;base64,'+row.pic_bank);
                $(".bank_id").val(row.id);
                $('#model_bank').modal('toggle');
            }
        </script>
    @endpush
@endsection
