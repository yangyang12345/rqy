@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $count['count_all'] }}</h3>

                    <p>用户总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $count['count_today'] }}</h3>

                    <p>今日用户增加数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $count['count_month'] }}</h3>

                    <p>当月用户增加数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ $count['count_active'] }}</h3>

                    <p>日活跃</p>
                </div>
                <div class="icon">
                    <i class="ion ion-eye"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">用户列表</h3>

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
                        <tr>
                            <th>id</th>
                            <th>openid</th>
                            <th>用户来源</th>
                            <th>昵称</th>
                            <th>用户邮箱</th>
                            <th>电话</th>
                            <th>加入时间</th>
                        </tr>
                        @foreach ($tokens as $token)
                            <tr>
                                <td>{{ $token->id }}</td>
                                <td>{{ $token->openid }}</td>
                                <td><span class="label label-info">
                                        @if($token->mark==0)
                                            微信用户
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $token->nickname }}</td>
                                <td>{{ $token->useremail }}</td>
                                <td>{{ $token->tel }}</td>
                                <td>{{ $token->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        {{ $tokens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection