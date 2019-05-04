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
                    <div class="col-lg-4 col-lg-offset-4">
                        <h1><i class="fa fa-key"></i>Available Permissions

                            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
                            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th>Permissions</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                            <form method="DELETE" action="{{ route('permissions.destroy',$permission->id) }}">
                                                <button type="submit" name="Delete" class="btn btn-danger">删除</button>
                                            </form>

                                            {{--{!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}--}}
                                            {{--{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                                            {{--{!! Form::close() !!}--}}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection