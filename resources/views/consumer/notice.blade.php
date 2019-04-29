@extends('admin/base_template/dashboard')
@section('content')
    @if(!empty(session('success')))
        　　<div class="alert alert-success" role="alert">
            　　　　{{session('success')}}
            </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">商家公告</h3>
                </div>
                <div class="box-body">
                    <div class="text-center article-title">
                        <h3>{!! $notice[0]->title !!}</h3>
                    </div>
                    <div class="pull-right">
                        发布时间：{!! $notice[0]->time !!}
                    </div>
                    <div class="intervel"></div>
                    <hr>
                    <div class="">
                        {!! $notice[0]->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection