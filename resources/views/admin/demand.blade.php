@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-bullhorn"></i>

                    <h3 class="box-title">未审核列表(请管理员及时处理相关项目)</h3>
                </div>
                <div class="box-body">
                    @if($demands_no_check->count())
                        @foreach($demands_no_check as $no)
                            <div class="callout callout-info" data-toggle="modal" FR-ajax="dialog" data_id="{{ $no->id }}" data-target="#modal-default">
                                <h4><i class="icon fa fa-ban"></i> {{ $no->title }}</h4>
                                {{ $no->nickname }}
                                {{ $no->created_at }}
                                {{ $no->company_address }}
                            </div>
                        @endforeach
                            {{ $demands_no_check->appends(array_except(Request::query(), 'demands_no_check'))->links() }}
                    @else
                        <div class="callout callout-success">
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            暂无需要处理的项目
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">审核未通过列表</h3>
                </div>
                <div class="box-body">
                    @if($demands_check_fail->count())
                        @foreach($demands_check_fail as $fail)
                            <div class="callout callout-danger">
                                <h4>{{ $fail->title }}</h4>
                                <p>
                                    {{ $fail->nickname }}
                                    {{ $fail->created_at }}
                                    {{ $fail->company_address }}
                                </p>
                            </div>
                        @endforeach
                            {{ $demands_check_fail->appends(array_except(Request::query(), 'demands_check_fail'))->links() }}
                    @else
                        <div class="callout callout-success">
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            暂无需要处理的项目
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">需求项目列表</h3>

                    {{--<div class="box-tools">--}}
                        {{--<div class="input-group input-group-sm" style="width: 150px;">--}}
                            {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

                            {{--<div class="input-group-btn">--}}
                                {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>用户</th>
                            <th>类型</th>
                            <th>标题</th>
                            <th>状态</th>
                            <th>公司地址</th>
                            <th>联系方式</th>
                            <th>操作</th>
                        </tr>

                        @foreach($demands as $demand)
                            <tr>
                                <td>{{ $demand->nickname }}</td>
                                <td>@include('admin/demand/type')</td>
                                <td>{{ $demand->title }}</td>
                                <td>@include('admin/demand/status')</td>
                                <td>{{ $demand->company_address }}</td>
                                <td>{{ $demand->contact }}</td>
                                <td>
                                    @if($demand->status < 2)
                                        <a title="审核项目" href="{{ url('/admin/demand/check/'.$demand->id) }}"><span class="fa fa-edit"></span></a>&nbsp;
                                    @endif
                                    <a title="查看项目" href="{{ url('/admin/demand/'.$demand->id) }}"><span class="fa fa-eye"></span></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        {{ $demands->appends(array_except(Request::query(), 'demands'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

