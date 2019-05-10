<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller{
    public function index(){
        return view('admin/check');
    }

    public function fund(){
        return view('admin/check/fund');
    }

    public function fund_list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $charge_type_name = empty($request->get('charge_type_name'))?'':$request->get('charge_type_name');
        $account = empty($request->get('account'))?'':$request->get('account');
        $account_name = empty($request->get('account_name'))?'':$request->get('account_name');
        $status = $request->get('status')==99?'':$request->get('status');

        $builder = DB::table('charge_record');

        if ($charge_type_name){
            $builder->where('charge_type_name','like','%'.$charge_type_name.'%');
        }

        if ($account){
            $builder->where('account','like','%'.$account.'%');
        }

        if ($account_name){
            $builder->where('account_name','like','%'.$account_name.'%');
        }

        if ($status!=''){
            $builder->where('status','=',$status);
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

    public function shop(){
        return view('admin/check/shop');
    }

    public function shop_list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $user = empty($request->get('user'))?'':$request->get('user');
        $type = $request->get('type')==99?'':$request->get('type');
        $status = $request->get('status')==99?'':$request->get('status');

        $builder = DB::table('shop');

        if ($user){
            $builder->where('user_id','like','%'.$user.'%');
        }

        if ($type!=''){
            $builder->where('type','=',$type);
        }

        if ($status!=''){
            $builder->where('status','=',$status);
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

    public function shop_list_test(){

        $builder = DB::table('shop');

        $list = $builder->orderBy('ctime', 'desc')->get()->toArray();

        $data = [
            "data"=>$list,
        ];
        return response()->json($data);
    }
}