@extends('admin/base_template/dashboard')
@section('content')
    <div class="no-print margin-bottom">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> 注意事项：</h4>
            请认真确认相关信息，准确审核
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">店铺审批</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('check.shop') }}" method="post" onsubmit="return sumbit_sure()">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="col-md-12">
                <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <span class="username margin-left-none"><a href="#">{{ $data->name }}</a></span>
                <span class="description margin-left-none">店铺提交于 - {{ $data->ctime }}</span>
              </div>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                  <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
              <img class="img-responsive" style="max-width:200px" src="{{ $data->photo }}" alt="Photo">

              <p></p>
              <button type="button" class="btn btn-default btn-xs">
                  <a href="{{ $data->url }}" target="_blank"><i class="fa fa-link"></i> 查看店铺</a>
                </button>
              <!-- <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button> -->
            </div>
            <div class="box-footer">
            <div class="row invoice-info">
                
                    <div class="col-sm-4 invoice-col">
                        <h3>商家信息</h2>
                        <address>
                            <strong>{{ $data->store_name }}</strong><br><br>
                            店铺聊天账号: {{ $data->wangwang }}<br><br>
                            店铺发货地址: {{ $data->province }}{{ $data->city }}{{ $data->district }}{{ $data->street }}<br><br>
                            商铺平台:
                            @if($data->type == 0)
                            淘宝
                            @elseif($data->type == 1)
                            京东
                            @elseif($data->type == 2)
                            拼多多
                            @endif
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>联系电话：</b> {{ $data->tel }}<br><br>
                        <b>审核状态：</b>
                        @if($data->status == 0)
                        未审核
                        @elseif($data->status == 1)
                        审核通过
                        @elseif($data->status == 2)
                        审核失败
                        @endif
                        <br><br>
                        <b>提交审核时间：</b>{{ $data->ctime }}<br>
                    </div>
                </div>
            </div>
            <!-- <div class="box-footer">
             
                <p>备注：</p>
                <div class="img-push">
                  <input type="text" class="form-control input-sm" placeholder="请填写备注">
                </div>
              
            </div> -->
          </div>
        </div>
                <div class="row no-print">
                    <div class="col-xs-12">
                        @if($data->status == 0)
                        <button type="submit" class="btn btn-primary pull-right"  style="margin-right: 5px;">
                            <i class="fa fa-credit-card"></i> 审核通过
                        </button>
                        @elseif($data->status == 2)
                        <button type="submit" class="btn btn-primary pull-right"  style="margin-right: 5px;">
                            <i class="fa fa-credit-card"></i> 审核通过
                        </button>
                        @endif
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('common-js')
        <script>
            function sumbit_sure(){
                var gnl=confirm("请确认信息是否属实?");
                if (gnl==true){
                    return true;
                }else{
                    return false;
                }
            }
        </script>
    @endpush

@endsection
