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
                <div class="box-header"><h5 class="box-title">任务详情</h5></div>
                <div class="box-body">
                {{ $task }}
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>商品详情</th>
                                <th>Progress</th>
                                <th style="width: 40px">Label</th>
                            </tr>
                            <tr>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                     </div>
                                    </td>
                                    <td><span class="badge bg-red">55%</span></td>
                            </tr>
                            <tr>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                     </div>
                                    </td>
                                    <td><span class="badge bg-red">55%</span></td>
                            </tr>
                            <tr>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                     </div>
                                    </td>
                                    <td><span class="badge bg-red">55%</span></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
	</div>
@endsection
