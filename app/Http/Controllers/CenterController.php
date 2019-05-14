<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CenterController extends Controller{
    public function index(){
        $user_id = Auth::id();

        $notice = DB::table('notice')->paginate(10);

        $capital = DB::table('capital_record')
            ->where('user_id','=',$user_id)
            ->orderByDesc('ctime')
            ->first();
        $brokerage = DB::table('brokerage_record')
            ->where('user_id','=',$user_id)
            ->orderByDesc('ctime')
            ->first();

        return view('consumer/center',['notice'=>$notice,'capital'=>$capital,'brokerage'=>$brokerage]);
    }

    public function ban(){
        return view('consumer/ban');
    }

    public function ban_list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = DB::table('ban');

        $total = $builder->count();
        $list = $builder->orderBy('ctime', 'desc')->offset($start)->take($length)->get()->toArray();

        $data = [
            "draw"=>$draw,
            "recordsTotal"=>$total,
            "recordsFiltered"=>$total,
            "data"=>$list,
        ];
        return response()->json($data);
    }
}