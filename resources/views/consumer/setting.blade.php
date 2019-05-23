@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">个人设置</h3>
                    <div class="box-tools">
                        
                    </div>
                </div>
                <div class="box-body no-padding">
                    <form method="get">
							<div class="form-group">
								<label class="col-sm-2 control-label"><h4>人气云ID</h3></label>
								<label class="col-sm-10 control-label"><h3 class="text-navy pull-left">46166</h3></label>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><h4>帐号</h4></label>
								<label class="col-sm-10 control-label"><h3 class="text-navy pull-left">18276137963</h3></label>
							</div>
							<!-- <div class="hr-line-dashed"></div>							 -->
							<div class="form-group">
								<label class="col-sm-2 control-label"><h3>QQ</h3></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="qq" placeholder="请输入QQ号码" maxlength="13" required="" oninvalid="setCustomValidity('请输入QQ号码')" oninput="setCustomValidity('')" pattern="^[1-9][0-9]{4,12}$" value="1049209561">
								</div>
							</div>
							<div class="hr-line-dashed"></div>							
							<div class="form-group">
								<label class="col-sm-2 control-label"><h3>微信</h3></label>
								<div class="col-sm-10">
									<input type="text" name="weixin" class="form-control" placeholder="请输入微信帐号" oninvalid="setCustomValidity('请输入微信帐号,不能为手机及邮箱帐号')" oninput="setCustomValidity('')" required="" pattern="^[a-zA-Z]+[a-zA-Z0-9_\-]*$" maxlength="20" value="yanjianhui25">
									<span class="help-block m-b-none">请输入微信帐号,不能为手机及邮箱帐号</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>							
							<div class="form-group">
								<label class="col-sm-2 control-label"><h3>性别</h3></label>
								<div class="col-sm-10">
									<input type="radio" name="sex" checked="" value="0" title="保密"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>保密</div></div><input type="radio" name="sex" value="1" title="先生"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>先生</div></div><input type="radio" name="sex" value="2" title="女士"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>女士</div></div>								</div>
							</div>
							<div class="hr-line-dashed"></div>							
							 <div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
								<button class="btn btn-lg btn-primary btn-block" type="submit">保存</button>
								</div>
							</div>
						</form>
                </div>
            </div>
        </div>
    </div>
@endsection()