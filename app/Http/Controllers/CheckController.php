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

    public function fund_check(Request $request){
        $id = $request->id;
        $data = DB::table('charge_record as c')
            ->leftJoin('users as u','c.user_id','=','u.id')
            ->select('c.id','c.user_id','c.account','c.account_name','c.fund','c.charge_type_name','c.ctime','u.name','u.email','u.tel','u.qq','u.wx','u.sex','u.created_at')
            ->where('c.id','=',$id)
            ->first();
        return view('admin/check/fund_comfire',['data'=>$data]);
    }

    public function fund_confim(Request $request){
        $id = $request->id;
        $user_id = $request->user_id;
        $fund = $request->fund;

        //审核通过
        DB::table('charge_record')
            ->where('id', '=',$id)
            ->update([
                'status' => 1,
                'vtime' => date('Y-m-d h:i:s',time())
            ]);
        //把本金充值写入本金详情表中

        $data = DB::table('capital_record')
            ->where('user_id','=',$user_id)
            ->orderByDesc('ctime')
            ->first();

        if (empty($data->balance)){
            $pre_blance = 0;
        }else{
            $pre_blance =$data->balance;
        }

        $balance = $pre_blance+$fund;

        $Getid = DB::table('capital_record')->insertGetId(
            [
                'user_id' => $user_id,
                'type' => '0',
                'in_out' => '0',
                'content' => '本金充值',
                'quota' => $fund,
                'balance' => $balance,
                'ctime'=>date('Y-m-d h:i:s',time())
            ]
        );

        if ($Getid){
            return redirect()->route('admin.fund')->with('success','审批成功');
        }

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