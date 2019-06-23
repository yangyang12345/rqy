<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">用户使用</li>
            <li class="{{ active_class(if_route('user.center')) }}"><a href="{{ url('/user/center') }}"><i class="fa fa-home"></i> <span>商家中心</span></a></li>
            <li class="treeview {{ active_class(if_uri_pattern('user/management/*'),'menu-open') }}">
                <a href="#"><i class="fa fa-cloud-upload"></i> <span>发布/管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu {{ active_class(if_uri_pattern('user/management/*')) }}" style="display: {{ active_class(if_uri_pattern('user/management/*'),'block') }}">
                    <li class="padding_l_20 {{ active_class(if_route('user.release_task')) }}"><a href="{{ route('user.release_task') }}"><i class="fa fa-circle-o"></i>发布推广任务</a></li>
                    <li class="padding_l_20 {{ active_class(if_route('user.advance_duty')) }}"><a href="{{ route('user.advance_duty') }}"><i class="fa fa-circle-o"></i>垫付任务管理</a></li>
                    <li class="padding_l_20 {{ active_class(if_route('user.browse_task')) }}"><a href="{{ route('user.browse_task') }}"><i class="fa fa-circle-o"></i>浏览任务管理</a></li>
                </ul>
            </li>
            <li class="{{ active_class(if_route('user.task')) }}"><a href="{{ route('user.task') }}"><i class="fa fa-cubes"></i> <span>垫付任务订单管理</span></a></li>
            <li class="{{ active_class(if_route('user.funds')) }}"><a href="{{ url('/user/funds/capital') }}"><i class="fa fa-credit-card"></i> <span>资金明细</span></a></li>
            <li class="{{ active_class(if_route('user.bind')) }}"><a href="{{ url('/user/bind') }}"><i class="fa fa-link"></i> <span>店铺管理</span></a></li>
            <li class="{{ active_class(if_route('user.explain')) }}"><a href="{{ url('/user/explain') }}"><i class="fa fa-exclamation-circle"></i> <span>申述中心</span></a></li>
            <li class="{{ active_class(if_route('user.plan')) }}"><a href="{{ url('/user/plan') }}"><i class="fa  fa-dollar"></i> <span>推广赚奖金</span><span class="pull-right-container"><small class="label pull-right bg-red">奖</small></span></a></li>
            <li class="{{ active_class(if_route('user.ban')) }}"><a href="{{ url('/user/ban') }}"><i class="fa fa-minus-circle"></i> <span>黑名单</span></a></li>
            @role('Administer')
            <li class="header">管理模块</li>
            <li class="treeview {{ active_class(if_uri_pattern('admin/check/*'),'menu-open') }}">
                <a href="#"><i class="fa fa-cloud-upload"></i> <span>审批管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu {{ active_class(if_uri_pattern('admin/check/*')) }}" style="display: {{ active_class(if_uri_pattern('admin/check/*'),'block') }}">
                    <li class="padding_l_20 {{ active_class(if_route('admin.fund')) }}"><a href="{{ route('admin.fund') }}"><i class="fa fa-circle-o"></i> <span>充值审批</span></a></li>
                    <li class="padding_l_20 {{ active_class(if_route('admin.task')) }}"><a href="{{ route('admin.task') }}"><i class="fa fa-circle-o"></i> <span>任务审批</span></a></li>
                    <li class="padding_l_20 {{ active_class(if_route('admin.shop')) }}"><a href="{{ route('admin.shop') }}"><i class="fa fa-circle-o"></i> <span>店铺审批</span></a></li>
                    <li class="padding_l_20 {{ active_class(if_route('admin.buyer')) }}"><a href="{{ route('admin.buyer') }}"><i class="fa fa-circle-o"></i> <span>买手审批</span></a></li>
                    <li class="padding_l_20 {{ active_class(if_route('admin.bank')) }}"><a href="{{ route('admin.bank') }}"><i class="fa fa-circle-o"></i> <span>银行卡审批</span></a></li>
                    <li class="padding_l_20 {{ active_class(if_route('admin.certification')) }}"><a href="{{ route('admin.certification') }}"><i class="fa fa-circle-o"></i> <span>实名认证</span></a></li>
                    <li class="padding_l_20 {{ active_class(if_route('admin.advance')) }}"><a href="{{ route('admin.advance') }}"><i class="fa fa-circle-o"></i> <span>提现审批</span></a></li>
                </ul>
            </li>
            {{--<li class="{{ active_class(if_uri_pattern('users')) }}"><a href="{{ url('/users') }}"><i class="fa fa-user"></i> <span>成员管理</span></a></li>--}}
            <li class="{{ active_class(if_route('admin.notice')) }}"><a href="{{ url('/admin/notice') }}"><i class="fa fa-bullhorn"></i> <span>发布公告</span></a></li>
            <li class="{{ active_class(if_uri_pattern('roles')) }}"><a href="{{ url('/roles') }}"><i class="fa fa-edit"></i> <span>角色管理</span></a></li>
            <li class="{{ active_class(if_uri_pattern('permissions')) }}"><a href="{{ url('/permissions') }}"><i class="fa fa-key"></i> <span>权限管理</span></a></li>
            <li><a href="{{ url('/user/api_doc') }}"><i class="fa fa-book"></i> <span>接口文档</span></a></li>
            @endrole
        </ul>
    </section>
</aside>