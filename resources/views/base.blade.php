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
                   
                </div>
            </div>
        </div>
	</div>
@endsection