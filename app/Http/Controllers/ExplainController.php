<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExplainController extends Controller{
    public function index(){
        return view('consumer/explain');
    }

    public function explain_list(Request $request){
        $user_id = Auth::id();
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $tid = empty($request->get('tid'))?'':$request->get('tid');
        $oid = empty($request->get('oid'))?'':$request->get('oid');
        $uid_type = $request->get('uid_type')==99?'':$request->get('uid_type');
        $status = $request->get('status')==99?'':$request->get('status');

        $builder = DB::table('explain');

        if ($uid_type == 1){
            $builder->where('user_id','=',$user_id);
        }elseif($uid_type == 2){
            $builder->where('user_id_to','=',$user_id);
        }else{
            $builder->where(function ($query) use ($user_id) {
                $query->where('user_id_to', '=', "{$user_id}")->orWhere('user_id', '=', "{$user_id}");
            });
        }

        if ($oid){
            $builder->where('order_id','like','%'.$oid.'%');
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

    public function push(){
        return view('consumer/explain_push');
    }

    public function refer(Request $request){

        $user_id = Auth::id();
        $order_id = $request->oid;
        $order_type = $request->otype;
        $explain_type = $request->etype;
        $desc = $request->note;

        $Getid = DB::table('explain')->insertGetId(
            [
                'user_id' => $user_id,
                'order_id' => $order_id,
                'order_type' => $order_type,
                'explain_type' => $explain_type,
                'desc' => $desc,
                'status'=>'0', //0 表示处理中
                'ctime'=>date('Y-m-d h:i:s',time())
            ]
        );

        if ($Getid){
            return redirect()->route('user.explain')->with('success','申述成功，请等待处理结果，如有问题，请及时联系客服');
        }
    }
}