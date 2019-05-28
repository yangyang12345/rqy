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
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header"><h5 class="box-title">个人设置</h5></div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('user.setting') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
								账号：
                            </label>
                            <div class="col-sm-8 control-label">
								<label class="text-red pull-left">18276137963</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
								QQ：
                            </label>
                            <div class="col-sm-8 control-label">
								<input class="form-control" placeholder="请输入qq号" id="qq" name="qq" type="text" value="{{ $info->qq }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
								微信：
							</label>
                            <div class="col-sm-8 control-label">
								<input class="form-control" placeholder="请输入微信账号" id="wx" name="wx" type="text" value="{{ $info->wx }}" >
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">
								性别：
							</label>
                            <div class="col-sm-8 control-label">
								<label class="pull-left"><input {{ $info->sex==0?'checked':''}} name="sex" type="radio" value="0" >保密</label>
								<label class="pull-left padding_l_20"><input {{ $info->sex==1?'checked':''}} name="sex" type="radio" value="1" >先生</label>
								<label class="pull-left padding_l_20"><input {{ $info->sex==2?'checked':''}} name="sex" type="radio" value="2" >女士</label>
                            </div>
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
	<div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header"><h5 class="box-title">修改密码</h5></div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('explain') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
								旧密码:
                            </label>
                            <div class="col-sm-8 control-label">
								<input class="form-control" id="old_password" name="old_password" type="password">
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">
								新密码:
                            </label>
                            <div class="col-sm-8 control-label">
								<input class="form-control" id="qq" name="new_password" type="password">
                            </div>
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