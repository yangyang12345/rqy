<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    public function index(Request $request) {
        $user_id = Auth::id();
        $type=$request->type;

        $capital = DB::table('capital_record')
            ->where('user_id','=',$user_id)
            ->orderByDesc('ctime')
            ->first();
        $brokerage = DB::table('brokerage_record')
            ->where('user_id','=',$user_id)
            ->orderByDesc('ctime')
            ->first();

        switch ($type){
            case 'capital':
                return view('consumer/funds/capital',['capital'=>$capital,'brokerage'=>$brokerage]);
                break;
            case 'brokerage':
                return view('consumer/funds/brokerage',['capital'=>$capital,'brokerage'=>$brokerage]);
                break;
        }
    }

    public function capital(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $user_id = Auth::id();

        $type = $request->get('type')==99?'':$request->get('type');


        $builder = DB::table('capital_record')->where('user_id','=',$user_id);

        if ($type != ''){
            $builder = $builder->where('type','=',$type);
        }

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

    public function brokerage(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $user_id = Auth::id();

        $type = $request->get('type')==99?'':$request->get('type');


        $builder = DB::table('brokerage_record')->where('user_id','=',$user_id);

        if ($type != ''){
            $builder = $builder->where('type','=',$type);
        }

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

