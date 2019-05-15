<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagementController extends Controller{
    function task(){
        $user_id = Auth::id();
        $shops = DB::table('shop')
            ->where('user_id','=',$user_id)
            ->get();
        return view('consumer/task',['shops'=>$shops]);
    }

    function advance(){
        return view('consumer/advance');
    }

    function browse(){
        return view('consumer/browse');
    }

    public function task_list(Request $request){


        $platform = $request->input('platform');

        $builder = DB::table('task_record as t')
            ->leftJoin('shop as s','t.shop_id','=','s.id')
            ->select('t.task_type','t.task_name','t.goods_name','t.goods_url','t.goods_key','t.goods_pic','t.goods_price','t.goods_num','s.store_name','s.wangwang','s.url')
            ->where('t.platform','=',$platform);

        $list = $builder->orderBy('t.ctime', 'desc')->get()->toArray();

        $data = [
            "data"=>$list,
        ];
        return response()->json($data);
    }
}