<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="never" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>广告平台</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/ad/main.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/ad/MultipleSelect.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/ad/loading.css")}}">

    <!-- jQuery 3 -->
    <script type="text/javascript" src="{{ asset("/bower_components/jquery/dist/jquery.min.js")}}"></script>

    <!-- Bootstrap 3.3.7 -->
    <script type="text/javascript" src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>

    <script type="text/javascript" src="{{ asset("/ad/MultipleSelect.js")}}"></script>

    <script type="text/javascript" src="{{ asset("/ad/clipboard.min.js")}}"></script>

    <style type="text/css">
        h4{
            position: absolute;
            left: 5px;
            font-size: 12px;
            color: #fff;
            padding: 5px;
            background-color: #fff;
            background-color: rgba(0,0,0,.5);
            line-height: 18px;
            z-index: 2;
            top: 40px;
        }
        .ad_footer{
            height: 30px;
            border-top: 1px solid #e3e3e5;
            position: relative;
            bottom: -1px;
            background-color: #d7e1ec;
            width: calc(100% + 2px);
            z-index: 2;
            color: #090909;
            line-height: 30px;
            padding: 0 5px;
            top: -20px;
        }
        .margin-right{
            margin-right: 10px;
        }

        .form-radius{
            border-top-right-radius: 5px!important;
            border-top-left-radius: 5px!important;
            border-bottom-right-radius:5px!important;
            border-bottom-left-radius:5px!important;
        }
        .itemlist{
            margin-bottom: 180px;
            z-index: 0;
            margin: 0 auto;
            margin-top: 10px;
            min-height: 800px;
            min-width: 1300px;
            text-align: justify;
        }

        .item{
            position: relative;
            display: inline-block;
            vertical-align: top;
            background: #eee;
            margin-top: 25px;
            width: 250px;
            height: 605px;
            margin-bottom: 40px;
        }
        .h_over{
            height: 605px;
            overflow: hidden;
            position: relative;
        }

        .panel:hover{
            background-color: #fef4e7;
            height: auto;
            z-index: 3;
            /*border: 1px solid red;*/
            border-top: none;
            opacity: 1;
            margin-left: -1px;
            padding-left: 4px;
            padding-bottom: 20px;
            min-height: 505px;
        }
        .rec{
            background-color: #fff;
            color: #428bca;
            border: 1px solid #fff;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-right:5px;
        }
        .type{
            font-size: 12px;
            background: red;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            line-height: 25px;
            color: #fff;
            display: inline-block;
            text-align: center;
            position: relative;
        }
        .toTop{
            font-family: iconfont;
            position: fixed;
            right: 10px;
            bottom: 60px;
            line-height: 50px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 50px;
            color: #858585;
            width: 50px;
            font-size: 36px;
            cursor: pointer;
            background-color: #fff;
            z-index: 99999;
        }
        .stat{
            left: 50%;
            position: absolute;
            transform: translateX(-50%);
        }
        .panel-title{
            font-size: 12px;
        }

        .panel-default>.panel-heading {
            color: #fff;
            background-color: #428bca;
        }

        #app{
            /*width: 1500px;*/
            margin: 0 auto;
            position: relative
        }
        .multiselect-group{
            text-align: center;
            
        }
        .mutip{
            display: block;
            float: left;
        }
        .select{
            background-color: #f0f8ff;
        }
        .multiselect-all{
            width: 100%!important;
        }

        .btn_copy{
            position: relative;
            display: none;
            width: 220px;
            margin-bottom: 5px
        }

        .item:hover .btn_copy{ display:block;}
        
        .fq-copy{
            background-color: rgba(92,173,255,1);
            color: #fff;
            cursor: pointer;
            z-index: 3000;
            width: 400px;
            font-size: 12px;
            border-radius: 10px;
        }

        .fq-copy{
            display: none;
        }

        .inherit_p{
            text-align: left;
        }

    </style>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/ads') }}">
                    领劵平台
                </a>
            </div>
        </div>
    </nav>

    <form id="form_search" onsubmit="return false" class="form_search" style="display: block; position: relative; width: calc(100% - 180px); margin: 0 auto;min-width: 1300px;">
        <input type="text" id="tb_keyword" class="form-control" placeholder="可搜索关键词、券连接、商品原始连接、商品ID" />
        <div  class="search_left_option_wapper">
            <select name="multiple" id="multiple" multiple="multiple" style="width:100%; display: none">
                @foreach($grouptypes as $g)
                    <optgroup label="{{ $g }}">
                        @foreach($grouplist as $v)
                            @if($v->t == $g)
                                <option selected = "selected" value="{{ $v->id }}">{{ $v->name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                @endforeach

            </select>

            <div class="option_wapper">
                <div>
                    <input name="cb_manping" type="checkbox" checked id="cb_manping">
                    <label for="cb_manping">满屏</label>
                </div>
                <div>
                    <input type="checkbox"  id="cb_weixinwenan">
                    <label style="color:red" for="cb_weixinwenan">微信文案</label>
                </div>
            </div>
        </div>
        <button class="button button-primary button-rounded" id="btn_search">搜索</button>
        <div class="cbwapper">
            <input type="checkbox" id="dis" />
            <label for="dis" style="color: red">一手券</label>
            <input type="checkbox" id="is_tqg" checked />
            <label for="is_tqg">淘抢购</label>
            <input type="checkbox" id="is_ju" checked />
            <label for="is_ju">聚划算</label>
            <input type="checkbox" id="is_richang" checked />
            <label for="is_richang">日常单</label>
            <input type="checkbox" id="is_guoye" checked />
            <label for="is_guoye">过夜单</label>
            <input type="checkbox" id="is_yugao" checked />
            <label for="is_yugao">预告</label>
        </div>
    </form>

    <div id="content" class="itemlist" style="width: calc(100% - 180px)"></div>

    <div class="toTop" onclick=" $('body,html').animate({scrollTop:0},500);">
        <img style="width: 40px" src="{{ asset('/back.png') }}">
    </div>

    <div id="fountainG">
        <div id="fountainG_1" class="fountainG">
        </div>
        <div id="fountainG_2" class="fountainG">
        </div>
        <div id="fountainG_3" class="fountainG">
        </div>
        <div id="fountainG_4" class="fountainG">
        </div>
        <div id="fountainG_5" class="fountainG">
        </div>
        <div id="fountainG_6" class="fountainG">
        </div>
        <div id="fountainG_7" class="fountainG">
        </div>
        <div id="fountainG_8" class="fountainG">
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            function loadingEffect() {
                var loading = $('#fountainG');
                loading.hide();
                $(document).ajaxStart(function () {
                    loading.show();
                }).ajaxStop(function () {
                    loading.hide();
                });
            }
            loadingEffect();

            var search = $("#tb_keyword").val();
            var is_weixinwenan = $("#cb_weixinwenan").is(':checked');
            var is_dis = $("#dis").is(':checked');
            var is_tqg = $("#is_tqg").is(':checked');
            var is_ju = $("#is_ju").is(':checked');
            var is_richang = $("#is_richang").is(':checked');
            var is_guoye = $("#is_guoye").is(':checked');
            var is_yugao = $("#is_yugao").is(':checked');


            $.ajax({
                type: "post",
                url: "/ads",
                data: {'_token':'{{csrf_token()}}',id:'0',multiple:'0',search:search,is_weixinwenan:is_weixinwenan,is_dis:is_dis,is_tqg:is_tqg,is_ju:is_ju,is_richang:is_richang,is_guoye:is_guoye,is_yugao:is_yugao},
                success: function(data){
                    $('#content').append(data);
                }
            });

            var range = 300;             //距下边界长度/单位px
            var totalheight = 0;
            $(window).scroll(function(){
                var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)

                totalheight = parseFloat($(window).height()) + parseFloat(srollPos);
                if(($(document).height()-range) <= totalheight) {
                    var id = $('.item:last').data('id');
                    var multiples = $("#multiple").val();
                    var multiple = multiples.join(",");
                    search = $("#tb_keyword").val();
                    is_weixinwenan = $("#cb_weixinwenan").is(':checked');
                    is_dis = $("#dis").is(':checked');
                    is_tqg = $("#is_tqg").is(':checked');
                    is_ju = $("#is_ju").is(':checked');
                    is_richang = $("#is_richang").is(':checked');
                    is_guoye = $("#is_guoye").is(':checked');
                    is_yugao = $("#is_yugao").is(':checked');
                    $.ajax({
                        type: "post",
                        url: "/ads",
                        data: {'_token':'{{csrf_token()}}',id:id,multiple:multiple,search:search,is_weixinwenan:is_weixinwenan,is_dis:is_dis,is_tqg:is_tqg,is_ju:is_ju,is_richang:is_richang,is_guoye:is_guoye,is_yugao:is_yugao},
                        // dataType: "json",
                        success: function(data){
                            $('#content').append(data);
                        }
                    });
                }
            });

            $('#btn_search').click(function() {
                var multiples = $("#multiple").val();
                search = $("#tb_keyword").val();
                is_weixinwenan = $("#cb_weixinwenan").is(':checked');
                is_dis = $("#dis").is(':checked');
                is_tqg = $("#is_tqg").is(':checked');
                is_ju = $("#is_ju").is(':checked');
                is_richang = $("#is_richang").is(':checked');
                is_guoye = $("#is_guoye").is(':checked');
                is_yugao = $("#is_yugao").is(':checked');
                var multiple = multiples.join(",");

                $.ajax({
                    type: "post",
                    url: "/ads",
                    data: {'_token':'{{csrf_token()}}',id:'0',multiple:multiple,search:search,is_weixinwenan:is_weixinwenan,is_dis:is_dis,is_tqg:is_tqg,is_ju:is_ju,is_richang:is_richang,is_guoye:is_guoye,is_yugao:is_yugao},
                    success: function(data){
                        $('#content').empty();
                        $('#content').append(data);
                    }
                });
            })

            $('#multiple').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                includeSelectAllOption: true,
                buttonWidth: '120px',
                dropRight: true,
                maxHeight: 300,
                nonSelectedText: '请选择',
                nSelectedText:'项被选中',
                numberDisplayed: 3,
                enableFiltering: true,
                allSelectedText:'全部',
                selectAllName:'全选',
                filterPlaceholder:'搜索',
                selectedClass: 'select',
                selectAllText:'全选'
            });

            $(document).on('mouseleave','.item', function(){
                $(this).find('.btn_copy').text('点击复制')
            });

        })

        new ClipboardJS('.btn_copy',{
            text: function(trigger) {
               $(trigger).text('已复制');
            }
        })


        function repla(own) {
            var self = $(own);
            var id = self.data('id');
            var div = $("#copy_" + id); //要浮动在这个元素旁边的层
            div.css("position", "absolute");//让这个层可以绝对定位

            div.css("display", "block");
            var p = self.position(); //获取这个元素的left和top
            var x = self.offset().left +self.width() + div.width()+100;//获取这个浮动层的left
            var docWidth = $(document).width();//获取网页的宽
            if (x > docWidth) {
                x = -382;
            }else{
                x = 240;
            }
            div.css("left", x);
            div.css("top", p.top);
            div.show();
        }

        function lev(own){
            var self = $(own);
            var id = self.data('id');
            var div = $("#copy_" + id);
            div.css("display", "none");
        }

    </script>


</div>
</body>
</html>