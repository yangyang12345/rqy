<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('global.title') }}</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/plugins/iCheck/all.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/ckeditor/skins/moono-lisa/editor.css")}}">


    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/css/main.css")}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Header -->
    @include('admin/base_template/header')

    <!-- Sidebar -->
    @include('admin/base_template/sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <title>{{ config('global.title') }}</title>
                <small>欢迎来到启拉！因为专业所以信赖</small>
            </h1>

{{--            @include('admin/base_template/breadcrumbs')--}}

        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('admin/base_template/footer')

    @include('admin/base_template/control')

    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    <div class="modal fade" id="modal-default" style="display: none;"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset("/bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- 表格 -->
<script src="{{ asset("/bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/bower_components/admin-lte/dist/js/adminlte.min.js")}}"></script>

<!-- ChartJS -->
<script src="{{ asset("/bower_components/chart.js/Chart.js")}}"></script>

<!-- SlimScroll -->
<script src="{{ asset("/bower_components/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>

<script src="{{ asset("/bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}"></script>

@stack('notice-js')

@stack('datatable-js')

@stack('common-js')

<!-- dialog 获取数据插件 -->
{{--<script src="{{ asset("/js/ajax.js") }}"></script>--}}

<!-- 省市三级联动 顺序并不能乱-->
<script src="{{ asset("/js/distpicker.data.min.js") }}"></script>
<script src="{{ asset("/js/distpicker.min.js") }}"></script>
<script src="{{ asset("/js/provice.js") }}"></script>

<script src="{{ asset("/js/normal.js") }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>