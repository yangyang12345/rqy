<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManagementController extends Controller{

    public function task(Request $request){

        $step = $request->step;
        if ($step == 1){
            $user_id = Auth::id();
            $shops = DB::table('shop')
                ->where('user_id','=',$user_id)
                ->get();
            // $capital = DB::table('capital_record as c')
            //     ->leftJoin('users as u','c.user_id','=','u.id')
            //     ->select('c.user_id','c.balance','u.name','u.email','u.tel','u.qq','u.wx')
            //     ->where('c.user_id','=',$user_id)
            //     ->orderByDesc('c.ctime')
            //     ->first();
            return view('consumer/management/task_one',['shops'=>$shops]);
        }

        if ($step == 2){
            return view('consumer/management/task_two');
        }

        
    }

    public function advance(){
        return view('consumer/management/advance');
    }

    public function advance_list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $user_id = Auth::id();


        $builder = DB::table('task_record')
            ->where('user_id','=',$user_id)
            ->where('task_type','=','0');


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

    function browse(){
        return view('consumer/management/browse');
    }

    public function browse_list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $user_id = Auth::id();


        $builder = DB::table('task_record')
            ->where('user_id','=',$user_id)
            ->where('task_type','=','1');


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

    /**
     * task_type
     * 1:手机淘宝/天猫任务 （用户在手机淘宝app下单）
     * 3:手机京东任务
     * 5:手机拼多多
     * 7:手机淘宝/天猫浏览、收藏、加购物车（全真人加购，不被屏蔽不降权。）
     * 9:手机京东浏览、收藏、加购物车
     * 11:手机拼多多浏览任务 （用户在手机拼多多上操作任务）
     * 
     */

    public function publish(Request $request){
        $step = $request->step;
    
        if ($step == 1) {
            $tasktype = $request->tasktype;
            $sid = $request->sid;

            $validator = Validator::make(
                $request->all(),
                [
                    'tasktype' => 'required',
                    'sid' => 'required',
                ],
                [
                    'tasktype.required' => '请先选择任务类型',
                    'sid.required' => '请先选择店铺',
                ]
            );

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            return redirect()->route('user.release_task',['step'=>2])->with(['tasktype' => $tasktype,'sid' => $sid]);
        }
        $serial = $request->serial;
        $wrap_task_type = $request->wrap_task_type;   // 任务类型,0表示垫付任务，1表示浏览任务
        $task_type = $request->task_type;
        $task_name = $request->wrap_task_type == 0?'垫付任务':'浏览任务';

        // 平台类型，1表示淘宝，2表示京东，3表示拼多多
        if(in_array($task_type,['1,7'])){
            $platform = 1;
        }

        if(in_array($task_type,['3,9'])){
            $platform = 2;
        }

        if(in_array($task_type,['7,11'])){
            $platform = 3;
        }
    
        $shop_id = $request->sid;
        $goods_name = $request->goods_name;
        $goods_url = $request->goods_url;
        $goods_key = $request->goods_keyword;
        $goods_price = $request->goods_price;
        $goods_num = $request->goods_num;
        $ctime = $request->ctime;
        $user_id = Auth::id();

        $goods_pic = $request->file('goods_pic');

        // 文件是否上传成功
        if ($goods_pic->isValid()) {

            // 获取文件相关信息
            $originalName = $goods_pic->getClientOriginalName(); // 文件原名
            $ext = $goods_pic->getClientOriginalExtension();     // 扩展名
            $realPath = $goods_pic->getRealPath();   //临时文件的绝对路径
            $type = $goods_pic->getClientMimeType();     // image/jpeg

//                if($uploadFilesize  > 1024*2*1000){
//                    echo "<font color=\"red\"size=\"2\">*图片大小不能超过2M</font>";
//                    exit;
//                }

            // 上传文件
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            //这里的uploads是配置文件的名称
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));

            $photo = '/uploads/'.$filename;//回调函数中的图片地址
        }

        $Getid = DB::table('task_record')->insertGetId(
            [
                'user_id'=>$user_id,
                'serial' => $serial,
                'task_type' => $task_type,
                'shop_id' => $shop_id,
                'goods_name' => $goods_name,
                'goods_url' => $goods_url,
                'goods_key'=>$goods_key,
                'goods_pic'=>$photo,
                'goods_price'=>$goods_price,
                'goods_num'=>$goods_num,
                'ctime'=>$ctime
            ]
        );

        if ($Getid){
            return redirect()->route('user.release_task.success');
        }
    }

    public function success(){
        return view('consumer/management/success');
    }
}