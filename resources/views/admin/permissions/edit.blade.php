@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">权限编辑</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class='col-lg-4 col-lg-offset-4'>

                        <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
                        <br>
                        <form method="PUT" action="{{ route('permissions.update',$permission->id) }}"></form>
{{--                        {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}--}}

                        <div class="form-group">
                            <label for="name">权限名称</label>
                            <input name="name" class="form-control">
                            {{ Form::label('name', 'Permission Name') }}
                        </div>
                        <br>
                        <button type="submit" name="Edit" class="btn btn-primary"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection