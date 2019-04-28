@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-md-2">
            <!-- The time line -->
            <ul class="timeline">
                <li class="time-label">
                  <span class="bg-red">
                    10 Feb. 2014
                  </span>
                </li>
                <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                        </div>
                    </div>
                </li>
                <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                        <h3 class="timeline-header no-border">备注</h3>
                    </div>
                </li>
                <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"></h3>

                        <div class="timeline-body">
                            xxx于什么时间开始审核
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                        </div>
                    </div>
                </li>
                <li class="time-label">
                  <span class="bg-green">
                    {{ $demand[0]->created_at }}
                  </span>
                </li>
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">
                        <span class="username"><a href="#">{{ $demand[0]->nickname }}</a></span>
                        <span class="description">需求创建日期 - {{ $demand[0]->created_at }}</span>
                    </div>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                            <i class="fa fa-circle-o"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="box-body">
                    <h2>{{ $demand[0]->title }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <small class="text-muted">{{ $demand[0]->company_address }}</small>
                    </h2>
                    <p>{{ $demand[0]->des }}</p>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>

                            <h3 class="box-title">项目相关信息</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <p class="text-green">项目类型：{{ $demand[0]->type }} （0-找资金，1-找资产，2-其他合作）</p>

                            @switch($demand[0]->type)
                                @case(0)
                                <p class="text-aqua">资产类型：{{ $demand[0]->asset_type }} （0-房抵，1-车抵，2-供应链，3-场景分期，4-现金分期，5-其他）</p>
                                @break
                                @case(1)
                                <p class="text-aqua">资产类型：{{ $demand[0]->fund_type }} （0-银行，1-消金，2-小贷，3-P2P，4-信托，5-保理，6-其他）</p>
                                <p class="text-aqua">资金成本要求：{{ $demand[0]->fund_start }}~{{ $demand[0]->fund_start }}</p>
                                @break
                            @endswitch

                            <p class="text-blue">征信方案：{{ $demand[0]->credit }} （0-比例保证金，1-平台主体担保，2-保险或担保公司担保，3-实际控制人连带担保，4-其他）</p>

                            <p class="text-light-blue">联系方式：{{ $demand[0]->contact_type }} （0-手机号，1-邮箱，2-微信号） &nbsp; {{ $demand[0]->contact }}</p>

                            <p class="text-yellow">审核状态：{{ $demand[0]->status }} （0-已提交，1-正在审核，2-审核通过，3-审核未通过）</p>

                            @if($demand[0]->status == '3' && !empty($demand[0]->reason))
                                <p class="text-red">审核未通过原因：{{ $demand[0]->reason }}</p>
                            @endif

                            <p class="text-muted">标签：{{ $demand[0]->tag_id }}</p>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> 收藏数</button>
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                    <br>
                    <span class="pull-right text-muted">45 likes - 2 comments</span>
                    <h4>评论列表</h4>
                </div>
                <div class="box-footer box-comments">
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ asset("/bower_components/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">

                        <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                            It is a long established fact that a reader will be distracted
                            by the readable content of a page when looking at its layout.
                        </div>
                    </div>
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ asset("/bower_components/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">

                        <div class="comment-text">
                      <span class="username">
                        Nora Havisham
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                            The point of using Lorem Ipsum is that it has a more-or-less
                            normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English.
                        </div>
                    </div>
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ asset("/bower_components/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">

                        <div class="comment-text">
                      <span class="username">
                        Nora Havisham
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                            The point of using Lorem Ipsum is that it has a more-or-less
                            normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English.
                        </div>
                    </div>
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ asset("/bower_components/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">

                        <div class="comment-text">
                      <span class="username">
                        Nora Havisham
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                            The point of using Lorem Ipsum is that it has a more-or-less
                            normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English.
                        </div>
                    </div>
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ asset("/bower_components/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">

                        <div class="comment-text">
                      <span class="username">
                        Nora Havisham
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                            The point of using Lorem Ipsum is that it has a more-or-less
                            normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection