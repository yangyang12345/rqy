@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">店铺管理</h3>
                    <button class="btn btn-info btn-xs pull-right" id="bind-shop">添加店铺</button>
                </div>
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending"
                                            style="width: 208px;">Rendering engine
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 255px;">Browser
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                            style="width: 227px;">Platform(s)
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending"
                                            style="width: 179px;">Engine version
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 131px;">CSS grade
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Firefox 1.0</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>1.7</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Firefox 1.5</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Firefox 2.0</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Firefox 3.0</td>
                                        <td>Win 2k+ / OSX.3+</td>
                                        <td>1.9</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Camino 1.0</td>
                                        <td>OSX.2+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Camino 1.5</td>
                                        <td>OSX.3+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Netscape 7.2</td>
                                        <td>Win 95+ / Mac OS 8.6-9.2</td>
                                        <td>1.7</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Netscape Browser 8</td>
                                        <td>Win 98SE+</td>
                                        <td>1.7</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Netscape Navigator 9</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td class="sorting_1">Gecko</td>
                                        <td>Mozilla 1.0</td>
                                        <td>Win 95+ / OSX.1+</td>
                                        <td>1</td>
                                        <td>A</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Rendering engine</th>
                                        <th rowspan="1" colspan="1">Browser</th>
                                        <th rowspan="1" colspan="1">Platform(s)</th>
                                        <th rowspan="1" colspan="1">Engine version</th>
                                        <th rowspan="1" colspan="1">CSS grade</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing
                                    1 to 10 of 57 entries
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" id="example1_previous"><a href="#"
                                                                                                                aria-controls="example1"
                                                                                                                data-dt-idx="0"
                                                                                                                tabindex="0">Previous</a>
                                        </li>
                                        <li class="paginate_button active"><a href="#" aria-controls="example1"
                                                                              data-dt-idx="1" tabindex="0">1</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="2" tabindex="0">2</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="3" tabindex="0">3</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="4" tabindex="0">4</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="5" tabindex="0">5</a></li>
                                        <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                        data-dt-idx="6" tabindex="0">6</a></li>
                                        <li class="paginate_button next" id="example1_next"><a href="#"
                                                                                               aria-controls="example1"
                                                                                               data-dt-idx="7"
                                                                                               tabindex="0">Next</a>
                                        </li>
                                    </ul>
                                </div>
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
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                                淘宝
                                            </label>
                                        </div>
                                        <div class="radio margin-r-20">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                京东
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
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
                                            <select class="form-control" id="province"></select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="sr-only" for="city">City</label>
                                            <select class="form-control" id="city"></select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="sr-only" for="district">District</label>
                                            <select class="form-control" id="district"></select>
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
                                            <input type="hidden" id="store_pic" name="store_pic" class="save"><br>
                                            <input type="file" class="fileToUpload " accept="image/*"><br>
                                            <span><p class="thumb_template"></p></span>
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
                    <button type="button" class="btn btn-primary">提交</button>
                </div>
            </div>
        </div>
    </div>
@endsection