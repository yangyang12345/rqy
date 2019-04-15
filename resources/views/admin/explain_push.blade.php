@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header"><h5 class="box-title">发起申诉</h5></div>
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="text-danger">*</span>订单ID：
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control m-b" id="oid" name="oid" type="number" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="text-danger">*</span>订单类型：</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" id="is_view" name="is_view" required="">
                                    <option value="99">请选择</option>
                                    <option value="0">推广任务</option>
                                    <option value="1">浏览任务</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <span class="label label-danger">商家发起申诉的订单会冻结返款与返佣，完结申诉自动解除冻结（才能返款与返佣）。</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span>选择申诉类型：</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" id="type" name="type" required="">
                                    <option value="0">请选择</option>
                                    <option value="1">浏览错商品或店铺</option>
                                    <option value="2">问题任务</option>
                                    <option value="3">用户做任务问题</option>
                                    <option value="4">用户确认收货，好评问题</option>
                                    <option value="6">淘宝客/村淘投诉</option>
                                    <option value="5">其它</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-danger">*</span>申诉内容：</label>
                            <div class="col-sm-8">
                                <textarea id="note" name="note" class="form-control" required="" aria-required="true" maxlength="200"
                                                            placeholder="请详细描述申诉原因及解决方案，最多200字"
                                                            oninvalid="setCustomValidity('请填写申诉内容')"
                                                            oninput="setCustomValidity('')"></textarea></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">添加图片证据：</label>
                            <div class="col-sm-8 clearfix">
                                <div class="pull-left">
                                    <div class="camera-area" data-id="1">
                                        <input class="save" type="hidden" id="pic1" name="pic1">
                                        <input type="file" class="fileToUpload hide" accept="image/*">
                                        <span><p class="thumb_template" onclick="j.upload(this);"></p></span>
                                        <span class="upload_progress"></span></div>
                                </div>
                                <div class="pull-left ml_10">
                                    <div class="camera-area" data-id="1">
                                        <input class="save" type="hidden" id="pic2" name="pic2">
                                        <input type="file" class="fileToUpload hide" accept="image/*">
                                        <span><p class="thumb_template" onclick="j.upload(this);"></p></span>
                                        <span class="upload_progress"></span></div>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-3"> 最多可添加2张图片，单张图片大小在2M以内</div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button class="btn btn-primary " type="submit"><i class="fa fa-check"></i>&nbsp;提交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection