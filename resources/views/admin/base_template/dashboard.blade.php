<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('global.title') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css")}}">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <!-- <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}">

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
                <small>分享，为了更加专业！</small>
            </h1>

            <!-- You can dynamically generate breadcrumbs here -->
            @include('admin/base_template/breadcrumbs')

        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
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

<!-- dialog 获取数据插件 -->
<script src="{{ asset("/js/ajax.js") }}"></script>

<script src="{{ asset("/js/model.js") }}"></script>

{{--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>--}}

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>