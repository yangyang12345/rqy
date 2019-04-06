<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Services\APIHelper;

class AdController extends Controller{

    static $t = array('聚','抢','夜','预');

    function index(Request $request){

        $api = new APIHelper();

        $header = [
            'Content-Type'=>'text/html; charset=utf-8',
        ];

        $apigrouplist = '/interface/grouplist';

        $grouplist =$api->get($apigrouplist,$header);

        $listall = json_decode($grouplist);

        $list = $listall->list;

        $grouptypes = $listall->grouptypes;

        return view('ad',['grouplist'=>$list,'grouptypes'=>$grouptypes]);
    }

    function item_list(Request $request){
        $id = $request->has('id')?$request->id:0;
        $search = $request->has('search')?$request->search:'';
        $multiple = $request->has('multiple')?$request->multiple:0;
        $isdis = $request->is_dis;
        $is_richang = $request->is_richang;
        $is_ju = $request->is_ju;
        $is_tqg = $request->is_tqg;
        $is_guoye = $request->is_guoye;
        $is_yugao = $request->is_yugao;
        $is_weixinwenan = $request->is_weixinwenan;

        $data = [
            'keyword'=>$search,
            'groupid'=>$multiple,
            'id'=> $id,
            'cid'=> 0,
            'yongjin'=>'',
            'isdis'=> $isdis,
            'is_richang'=> $is_richang,
            'is_ju'=> $is_ju,
            'is_tqg'=> $is_tqg,
            'is_guoye'=> $is_guoye,
            'is_yugao'=> $is_yugao,
            'is_weixinwenan'=> $is_weixinwenan,
            'endtime'=>'',
        ];
        $body = $data;
        $apiStr = '/Interface/search';
        $api = new APIHelper();
        $res =$api->post($body,$apiStr);
        $all = json_decode($res);
        $ads = $all->list;
        $data = '';
        foreach ($ads as $ad){
            $array = explode('[image=', $ad->MsgContent);

            foreach ($ad->t as $k=>$v){
                if ($v == true){
                    $ad->type = self::$t[$k];
                }
            }

            if (empty($array[1])){
                $image = '';
                $content = explode("\n",$array[0]);
            }else{
                list($image, $content) = explode(']', $array[1]);
                $content = explode("\n",$content);
            }



            $data .= <<<EOT
       <div class="item"data-id="{$ad->Id}">
       <div class="fq-copy" id="copy_{$ad->Id}" '>
EOT;
    foreach ($content as $k=>$v){
        $data.="<p class='inherit_p'>{$v}</p>";
    }
    $data.="{$ad->info}</div>";
            $data .= <<<EOT
                    <h4>
                            <p>{$ad->info}</p>
                    </h4>
                    <div class="panel panel-default h_over">
                        <div class="panel-heading">
                            <span class="panel-title">
                            {$ad->GroupName}
                            {$ad->SendTime}
                            </span>
EOT;
            if (!empty($ad->type)){
                $data.="<a target='_blank' href='#' class='float-right type'>{$ad->type}</a>&nbsp";
            }
            $data.=<<<EOT
                            <a target="_blank" href="/item/{$ad->itemid}" class="float-right rec">记录</a>
                        </div>
                        <div class="panel-body">
                        <img src="{$image}" class="img-rounded img-responsive"><br>
<button class="btn btn-info btn_copy" onmouseover="repla(this)" onmouseleave="lev(this)" data-id="{$ad->Id}" data-clipboard-action="copy" data-clipboard-target="#copy_{$ad->Id}">点击复制</button>
EOT;
            foreach ($content as $k=>$v){
                if ($k != 0){
                    if (strstr($v,'http')){
                        $ht = explode("https",$v);
                        foreach ($ht as $key=>$h){
                            if ($key==0){
                                $data.=$h;
                            }else{
                                $data.=<<<EOT
<a style="display: inherit;" target="_blank" style="word-wrap:break-word;" href="https{$h}">https{$h}</a><br>
EOT;
                            }
                        }
                    }else{
                        $data.=<<<EOT
<p>{$v}</p>
EOT;
                    }
                }
            }
            $data.=<<<EOT
</div></div>
<div class="ad_footer">
<span>{$ad->coupontime}</span>
<span class="float-right">{$ad->couponnumber}</span>
</div>
</div>
EOT;
        }
        return $data;
    }

    function record(Request $request){

        $id = $request->id;

        $date = $request->date;

        $header = [
            'Content-Type'=>'text/html; charset=utf-8',
        ];
//        var_dump($date);exit();

        $apiStr = '/item/'.$id.'?date='.$date;

        $api = new APIHelper();

        $res =$api->get($apiStr,$header);

        /*
         * 载入html字符串
         * 对拉取过来的html进行改造
         */
        $html = str_get_html($res);

        $foot = $html->find('.footer',0);
        $foot->outertext = '';
        $foot->outertext = '<div class="footer">© 2017-2018 || 领劵平台</div>';


//        foreach( $html->find('div[class="cbinfo"]') as $e){
//            $e->outertext='';
//        }

        foreach( $html->find('.priceline input') as $e){
            $e->outertext='';
        }

//        foreach( $html->find('script') as $e){
//            $e->outertext='';
//        }

        foreach( $html->find('.glyphicon') as $e){
            $e->outertext='';
        }

        $link1 = $html->find('link',1);
        $link2 = $html->find('link',2);
        $link1->href = "/ad/layer.css";
        $link1->rel = "stylesheet";
        $link2->href = "/ad/bundles.css";

        $script2 = $html->find('script',2);
        $script3 = $html->find('script',3);
        $script4 = $html->find('script',4);
        $script2->src = "/ad/jq.js";
        $script3->src = "/ad/layer.js";
        $script4->src = "/ad/template-web.js";

        $doc = $html;

        echo $doc;

    }
}