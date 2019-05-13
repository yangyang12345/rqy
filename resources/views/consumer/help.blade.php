@extends('admin/base_template/dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">帮助中心</h3>
                </div>
                <div class="box-body">
                    <div class="text-center article-title">
                        <h1>商家后台查看价格表</h1>
                    </div>
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <h1 style="font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;">
                                    <img src="{{ asset('/images/price.png') }}" title="价格表"
                                         alt="价格表"></h1>
                                <p>手机垫付单、电脑垫付单和特别垫付单都是统一价格。平台返款服务费2元/单。</p>
                                <p>普通浏览单0.6元/单，浏览+收藏 或者 浏览+购物车 或者 浏览+垫付+收藏 1.2元/单。</p>
                                <p>其他活动单子（例如天天特价等）参照价格表。</p>
                                <p>如有其他买手属性的要求（性别、信誉等），以发布任务时页面显示的增值价格为准。（增值价格是指在下图价格表的基础上所增加的价格）</p>
                                <p>如需要配套快递，淘宝/天猫2.8元/单&nbsp; &nbsp;京东/拼多多1.8元/单。</p>
                                <p>多连接任务，每增加1个连接增加2元。</p>
                                <p>指定关键词好评（文字好评） 每单增加1元。</p>
                                <p>图文好评 每单增加3元。</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection