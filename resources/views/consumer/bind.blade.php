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
                    <h3 class="box-title">店铺管理</h3>
                    <button class="btn btn-info btn-xs pull-right" id="bind-shop">添加店铺</button>
                </div>
                <div class="box-body">
                    <div id="bind" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="bind_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="bind_table" style="width:100%">
                                    <thead>
                                    <tr role="row">
                                        <th>店铺类型</th>
                                        <th>店铺名称</th>
                                        <th>店铺截图</th>
                                        <th>发货信息</th>
                                        <th>控制店铺接单间隔</th>
                                        <th>审核状态</th>
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

    <div class="modal fade" id="Modal_shop" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('bind.shop',['id'=>Auth::id()]) }}"  enctype="multipart/form-data">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="display: inline-block">
                        添加店铺
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">店铺信息</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4"><h5>选择平台</h5></div>
                                <div class="col-sm-8">
                                    <div class="form-group form-inline">
                                        <div class="radio margin-r-20">
                                            <label>
                                                <input type="radio" name="shop_type" value="0" checked="">
                                                淘宝
                                            </label>
                                        </div>
                                        <div class="radio margin-r-20">
                                            <label>
                                                <input type="radio" name="shop_type" value="1">
                                                京东
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="shop_type" value="2">
                                                拼多多
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">店铺名称</label>
                                    <div class="col-sm-8">
                                        <input name="store_name" type="text" class="form-control" required="">
                                        <span class="help-block font-s-12">务必跟手机端宝贝页显示的店铺名一致</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">店铺聊天帐号</label>
                                    <div class="col-sm-8"> <input id="wangwang" name="wangwang" type="text" class="form-control" required="">
                                        <span class="help-block font-s-12">绑定后无法修改</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">刷手接单间隔设置(天)</label>
                                    <div class="col-sm-8">
                                        <input name="gap_day" type="number" class="form-control" onkeyup="value=value.replace(/[^\d]/,'')" min="20" required="" value="20">
                                        <span class="help-block font-s-12">买手购过同一个店铺默认不低于20天后才可复购</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">店铺首页网址</label>
                                    <div class="col-sm-8">
                                        <input name="store_url" type="text" class="form-control store_url" required="">
                                        <span class="help-block font-s-12">绑定后无法修改</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <label class="col-sm-4 control-label">发件地址</label>
                                <div data-toggle="distpicker" class="col-sm-8">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label class="sr-only" for="province">Province</label>
                                            <select class="form-control" id="province" name="province"></select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="sr-only" for="city">City</label>
                                            <select class="form-control" id="city" name="city"></select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="sr-only" for="district">District</label>
                                            <select class="form-control" id="district" name="district"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">街道地址</label>
                                    <div class="col-sm-8">
                                        <input name="addr" type="text" class="form-control" required="">
                                        <span class="help-block m-b-none text-danger">发空包时，发货地址与电话必须无误。</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">发货电话</label>
                                    <div class="col-sm-8">
                                        <input name="tel" type="text" class="form-control" required="">
                                        <span class="help-block m-b-none text-danger">发空包时，发货地址与电话必须无误。</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">店铺图片</label>
                                    <div class="col-sm-8">
                                        <div class="camera-area" data-id="1">
                                            {{--<input type="hidden" id="store_pic" name="store_pic" class="save"><br>--}}
                                            <input type="file" name="pic" class="fileToUpload " accept="image/*"><br>
                                            {{--<span><p class="thumb_template"></p></span>--}}
                                            <p><a href="/images/1.jpg" target="_blank">查看示例</a></p>
                                            <span class="upload_progress"></span>
                                        </div>
                                        <span class="help-block m-b-none">为避免恶意绑定他人店铺必须上传店铺的后台登录截图</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            请认真仔细填写相关资料
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" name="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    @push('datatable-js')
        <script type="text/javascript">
            $dataTable = $("#bind_table");
            var table = $dataTable.DataTable({
                "ordering": false,//排序 关闭
                "searching": false,//是否显示搜索框，
                "processing": true,
                "serverSide": true,
                "pageLength": 6,
                "lengthMenu": [6, 10, 15],
                "ajax": {
                    "url": "{{ route('shop.getList') }}",
                    "type":"post",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {'data':'type',"defaultContent": " ",'className':''},
                    {'data':'store_name',"defaultContent": " ",'className':''},
                    {'data':'url',"defaultContent": " ",'className':''},
                    {'data':'province',"defaultContent": " ",'className':''},
                    {'data':'gap_day',"defaultContent": " ",'className':''},
                    {'data':'status',"defaultContent": " ",'className':''},
                ],
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            if (data == 0){
                                return '<img src="{{ asset('images/t.png') }}"><span>淘宝</span>'
                            }else if(data == 1){
                                return '<img src="{{ asset('images/j.png') }}"><span>京东</span>'
                            }else if (data == 2){
                                return '<img src="{{ asset('images/p.png') }}"><span>拼多多</span>'
                            }
                        },
                        "targets": 0
                    },
                    {
                        "render": function (data, type, row) {
                            return '<p>'+row.store_name+'</p>'+
                                    '<p>'+row.wangwang+'</p>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function (data, type, row) {
                            return '<img width="50" height="50" src="'+row.photo+'"><br>'+'<a href="'+row.url+'" target="_blank">查看店铺</a>'
                        },
                        "targets": 2
                    },
                    {
                        "render": function (data, type, row) {
                            return '<p>发货电话：'+row.tel+'</p>'+
                                '<p>'+row.province+row.city+row.district+row.street+'</p>';
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
                                return '<span><small class="label bg-red">失败</small></span>'
                            }
                        },
                        "targets": 5
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