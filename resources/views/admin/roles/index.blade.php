@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">角色编辑</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h1><i class="fa fa-key"></i> Roles

                            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
                            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>角色</th>
                                    <th>权限</th>
                                    <th>操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($roles as $role)
                                    <tr>

                                        <td>{{ $role->name }}</td>

                                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                        <td>
                                            <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                            {!! Form::submit('删除', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        <a href="{{ URL::to('roles/create') }}" class="btn btn-success">添加角色</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection