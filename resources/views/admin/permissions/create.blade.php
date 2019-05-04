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

                        <h1><i class='fa fa-key'></i> Add Permission</h1>
                        <br>

                        <form action="{{ route('permissions.create') }}"></form>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div><br>
                        @if(!$roles->isEmpty()) //If no roles exist yet
                        <h4>Assign Permission to Roles</h4>

                        @foreach ($roles as $role)
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" />
                            <label for="{{ $role->name }}">{{ ucfirst($role->name) }}</label><br>
                        @endforeach
                        @endif
                        <br>
                        <button class="btn btn-primary" type="submit" name="add">添加权限</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection