<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller{
    public function index(){
        return view('admin/check');
    }

    // 资金审核
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

    // 任务审批
    public function task(Request $request){
        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');


            $serial = empty($request->get('serial'))?'':$request->get('serial');
            $status = $request->get('status')==99?'':$request->get('status');

            $builder = DB::table('task_record')->whereNotIn('status',[0,1]);

            if ($serial){
                $builder->where('serial','like','%'.$serial.'%');
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
        return view('admin/check/task');
    }

    public function task_check(Request $request){
        if (!$request->has('task_id')){
            return redirect()->route('admin.task')->with('fail','请规范操作');
        }
        $id = $request->task_id;
        $user_id = Auth::id();
        $s = $request->submit;

         
         $now = DB::table('task_record')
         ->where('id', '=', $id)
         ->first();

        if($s == 'nopass'){
            $status = 3;

           // 如果审核没通过就退款

            $pre = DB::table('capital_record')
                ->where('user_id', '=', $user_id)
                ->select('balance')
                ->orderByDesc('ctime')
                ->first();

            $money = $now->total+$pre->balance;

            $Getid = DB::table('capital_record')->insertGetId(
                [
                    'user_id' => $user_id,
                    'type' => '2',
                    'in_out' => '0',
                    'content' => '撤销任务退款',
                    'quota' => $now->total,
                    'balance' => $money,
                    'ctime' => date('Y-m-d h:i:s', time())
                ]
            );
            
        }
        if($s == 'pass'){
            $status = 4;

            // 如果审核通过就发布订单
            $order_list = [];

            for ($n=0; $n<$now->commen_num; $n++) {
                $temp = [
                    'user_id' => $user_id,
                    'wrap_type' => $now->wrap_type,
                    'type' => $now->task_type,
                    'serial' => date('YmdHis').substr(microtime(), 2, 5) . mt_rand(10000,99999).$user_id,
                    'keywords' => $now->goods_key,
                    'task' => $now->id,
                    'shop' => $now->shop_id,
                    'goods_url' => $now->goods_url,
                    'status' => 0,
                    'charge' => $now->wrap_type==0?'2':'0.5',
                    'ctime' => date('Y-m-d h:i:s',time())
                ];
                array_push($order_list,$temp);
            } 

            $r = DB::table('order_record')->insert($order_list);
        }

        $result = DB::table('task_record')
            ->where('id', '=',$id)
            ->update([
                'status' => $status,
        ]);

        if($result){
            return redirect()->route('admin.buyer')->with('success','审核成功，未通过的任务将会返款，通过的任务将会发布订单！');
        }
        return redirect()->route('admin.buyer')->with('fail','审核失败，系统繁忙，请重试');
    }


    // 店铺审核
    public function shop(Request $request){

        if ($request->isMethod('post')) {
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

        return view('admin/check/shop');
    }

    public function shop_check(Request $request){
        $id = $request->id;
        if($request->isMethod('post')){
             //审核通过
             DB::table('shop')
              ->where('id', '=',$id)
              ->update([
                  'status' => 1,
                  ]);

        return redirect()->route('admin.shop')->with('success','审批成功');
        }
        $data = DB::table('shop as s')
            ->leftJoin('users as u','s.user_id','=','u.id')
            ->select('s.id','u.name','s.type','s.store_name','s.wangwang','s.url','s.province','s.city','s.district','s.street','s.tel','s.photo','s.status','s.ctime')
            ->where('s.id','=',$id)
            ->first();
        return view('admin/check/shop_comfire',['data'=>$data]);
    }


    //买手审核
    public function buyer(Request $request){

        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');


            $name = empty($request->get('name'))?'':$request->get('name');
            $status = $request->get('status')==99?'':$request->get('status');

            $builder = DB::table('buyer');

            if ($name){
                $builder->where('name','like','%'.$name.'%');
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

        return view('admin/check/buyer');
    }

    public function buyer_check(Request $request){
        if (!$request->has('buyer_id')){
            return redirect()->route('admin.buyer')->with('fail','请规范操作');
        }
        $id = $request->buyer_id;
        $s = $request->submit;
        if($s == 'nopass'){
            $status = 2;
        }
        if($s == 'pass'){
            $status = 1;
        }

        $result = DB::table('buyer')
            ->where('id', '=',$id)
            ->update([
                'status' => $status,
        ]);

        if($result){
            return redirect()->route('admin.buyer')->with('success','审核成功');
        }
        return redirect()->route('admin.buyer')->with('fail','审核失败，系统繁忙，请重试');
    }

    // 银行卡审核
    public function bank(Request $request){

        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');


            $name = empty($request->get('name'))?'':$request->get('name');
            $status = $request->get('status')==99?'':$request->get('status');

            $builder = DB::table('bank');

            if ($name){
                $builder->where('name','like','%'.$name.'%');
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
        return view('admin/check/bank');
    }

    public function bank_check(Request $request){
        if (!$request->has('bank_id')){
            return redirect()->route('admin.bank')->with('fail','请规范操作');
        }
        $id = $request->bank_id;
        $s = $request->submit;
        if($s == 'nopass'){
            $status = 2;
        }
        if($s == 'pass'){
            $status = 1;
        }

        $result = DB::table('bank')
            ->where('id', '=',$id)
            ->update([
                'status' => $status,
        ]);

        if($result){
            return redirect()->route('admin.bank')->with('success','审核成功');
        }
        return redirect()->route('admin.bank')->with('fail','审核失败，系统繁忙，请重试');
    }

    // 实名认证审核
    public function certification(Request $request){
        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');


            $name = empty($request->get('name'))?'':$request->get('name');
            $status = $request->get('status')==99?'':$request->get('status');

            $builder = DB::table('certification as c')
                ->leftJoin('users as u', 'c.user_id', '=', 'u.id')
                ->select('c.id','c.name as cname','c.card','c.pic_front','c.pic_back','c.status','u.name as uname');

            if ($name){
                $builder->where('c.name','like','%'.$name.'%');
            }

            if ($status!=''){
                $builder->where('c.status','=',$status);
            }


            $total = $builder->count();
            $list = $builder->orderBy('c.ctime', 'desc')->offset($start)->take($length)->get()->toArray();

            $data = [
                "draw"=>$draw,
                "recordsTotal"=>$total,
                "recordsFiltered"=>$total,
                "data"=>$list,
            ];
            return response()->json($data);
        }
        return view('admin/check/certification');
    }

    public function certification_check(Request $request){
        if (!$request->has('certification_id')){
            return redirect()->route('admin.certification')->with('fail','请规范操作');
        }
        $id = $request->certification_id;
        $s = $request->submit;
        if($s == 'nopass'){
            $status = 3;
        }
        if($s == 'pass'){
            $status = 2;
        }

        $result = DB::table('certification')
            ->where('id', '=',$id)
            ->update([
                'status' => $status,
        ]);

        if($result){
            return redirect()->route('admin.certification')->with('success','审核成功');
        }
        return redirect()->route('admin.certification')->with('fail','审核失败，系统繁忙，请重试');
    }

    // 提现审批
    public function advance(Request $request){
        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');


            $name = empty($request->get('name'))?'':$request->get('name');
            $status = $request->get('status')==99?'':$request->get('status');

            $builder = DB::table('advance_record as c')
                ->leftJoin('users as u', 'c.user_id', '=', 'u.id')
                ->leftJoin('bank as b', 'c.bank_id', '=', 'b.id')
                ->select('c.id','c.serial','c.balance','c.status','c.ctime','u.name','b.card');

            if ($name){
                $builder->where('u.name','like','%'.$name.'%');
            }

            if ($status!=''){
                $builder->where('c.status','=',$status);
            }


            $total = $builder->count();
            $list = $builder->orderBy('c.ctime', 'desc')->offset($start)->take($length)->get()->toArray();

            $data = [
                "draw"=>$draw,
                "recordsTotal"=>$total,
                "recordsFiltered"=>$total,
                "data"=>$list,
            ];
            return response()->json($data);
        }
        return view('admin/check/advance');
    }
}