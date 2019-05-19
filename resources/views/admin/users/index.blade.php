@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">成员管理</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h1><i class="fa fa-users"></i> 用户管理 <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">角色</a>
                            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">权限</a></h1>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>电话</th>
                                    <th>注册时间</th>
                                    <th>用户角色</th>
                                    <th>操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($users as $user)
                                    <tr>

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->tel }}</td>
                                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">编辑</a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                                            {!! Form::submit('删除', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{--<a href="{{ route('users.create') }}" class="btn btn-success">添加用户</a>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
