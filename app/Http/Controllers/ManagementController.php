<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class ManagementController extends Controller
{

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

    public function task(Request $request)
    {
        $user_id = Auth::id();

        if ($request->isMethod('post')) {
            // $step = $request->step;

            // if ($step == 1) {
            //     $tasktype = $request->tasktype;
            //     $sid = $request->sid;

            //     $validator = Validator::make(
            //         $request->all(),
            //         [
            //             'tasktype' => 'required',
            //             'sid' => 'required',
            //         ],
            //         [
            //             'tasktype.required' => '请先选择任务类型',
            //             'sid.required' => '请先选择店铺',
            //         ]
            //     );

            //     if ($validator->fails()) {
            //         return redirect()
            //             ->back()
            //             ->withErrors($validator)
            //             ->withInput();
            //     }

            //     return redirect()->route('user.release_task')->with(['tasktype' => $tasktype,'sid' => $sid]);
            // }
            $serial = date('YmdHis') . $user_id;
            $wrap_type = $request->wrap_type;   // 任务类型,0表示垫付任务，1表示浏览任务

            $task_type = $request->tasktype;
            $task_name = $request->wrap_type == 0 ? '垫付任务' : '浏览任务';

            // 平台类型，0表示淘宝，1表示京东，2表示拼多多
            if (in_array($task_type, ['1', '7'])) {
                $platform = 0;
            }

            if (in_array($task_type, ['3', '9'])) {
                $platform = 1;
            }

            if (in_array($task_type, ['5', '11'])) {
                $platform = 2;
            }

            $shop_id = $request->sid;
            $goods_name = $request->goods_name;
            $goods_url = $request->goods_url;
            $goods_key = $request->goods_keyword;
            $goods_price = $request->has('goods_price') ? $request->goods_price : '';
            $goods_num = $request->has('goods_num') ? $request->goods_num : '';

            $sort_style = $request->sort_style;
            $list_price = $request->list_price;
            $receive_num = $request->receive_num;
            $filter = $request->filter;
            $order_msg = $request->order_msg;
            $commen_keywords = $request->commen_keywords;
            $commen_num = $request->commen_num;

            $ctime = date('Y-m-d H:i:s', time());

            $goods_pic = $request->file('goods_pic');
            if ($wrap_type == 0){
                $total = ($goods_price*$goods_num+2+2)*$commen_num;
            }
            if ($wrap_type == 1){
                $total = $commen_num*0.5;
            }

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

                $photo = '/uploads/' . $filename; //回调函数中的图片地址
            }

            $Getid = DB::table('task_record')->insertGetId(
                [
                    'user_id' => $user_id,
                    'serial' => $serial,
                    'wrap_type' => $wrap_type,
                    'task_type' => $task_type,
                    'task_name' => $task_name,
                    'platform' => $platform,
                    'shop_id' => $shop_id,
                    'goods_name' => $goods_name,
                    'goods_url' => $goods_url,
                    'goods_key' => $goods_key,
                    'goods_pic' => $photo,
                    'goods_price' => $goods_price,
                    'goods_num' => $goods_num,
                    'list_price' => $list_price,
                    'sort_style' => $sort_style,
                    'receive_num' => $receive_num,
                    'filter' => $filter,
                    'order_msg' => $order_msg,
                    'commen_keywords' => $commen_keywords,
                    'commen_num' => $commen_num,
                    'status' => 0,
                    'total' => $total,
                    'ctime' => $ctime
                ]
            );

            if ($Getid) {
                return redirect()->route('user.release_task.info', ['id' => Crypt::encrypt($Getid), 'wrap_type' => $wrap_type]);
            }
        }


        $shops = DB::table('shop')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', '1')
            ->get();
        // $capital = DB::table('capital_record as c')
        //     ->leftJoin('users as u','c.user_id','=','u.id')
        //     ->select('c.user_id','c.balance','u.name','u.email','u.tel','u.qq','u.wx')
        //     ->where('c.user_id','=',$user_id)
        //     ->orderByDesc('c.ctime')
        //     ->first();
        return view('consumer/management/task_one', ['shops' => $shops]);
    }

    public function info(Request $request)
    {
        $user_id = Auth::id();
        if (!$request->has('id')) return redirect()->route('user.center');
        if (!$request->has('wrap_type')) return redirect()->route('user.center');

        $id = Crypt::decrypt($request->id);

        $wrap_type = $request->wrap_type;

        if ($wrap_type == 0) {
            $task = DB::table('task_record')
                ->where('id', '=', $id)
                ->first();
            $money = DB::table('capital_record')
                ->where('user_id', '=', $user_id)
                ->select('balance')
                ->orderByDesc('ctime')
                ->first();
            return view('consumer/management/info', ['task' => $task, 'money' => $money]);
        }

        if ($wrap_type == 1) {
            $task = DB::table('task_record')
                ->where('id', '=', $id)
                ->first();
            $money = DB::table('capital_record')
                ->where('user_id', '=', $user_id)
                ->select('balance')
                ->orderByDesc('ctime')
                ->first();
            return view('consumer/management/info_browse', ['task' => $task, 'money' => $money]);
        }
    }

    /**
     * 用于换一个加密的id
     */
    public function change_id(Request $request)
    {
        $id = $request->id;

        return response()->json(['id' => Crypt::encrypt($id)]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $result = DB::table('task_record')
            ->where('id', '=', $id)
            ->update([
                'status' => '1',
            ]);

        if ($result) {
            return redirect()->route('user.advance_duty')->with('success', '取消任务成功');
        } else {
            return redirect()->route('user.advance_duty')->with('fail', '系统繁忙，请稍后再试');
        }
    }

    public function pay(Request $request)
    {

        $pay = $request->pay;
        $id = Crypt::decrypt($request->id);
        $wrap_type = $request->wrap_type;
        $user_id = Auth::id();
        $money = DB::table('capital_record')
            ->where('user_id', '=', $user_id)
            ->select('balance')
            ->orderByDesc('ctime')
            ->first();

        if ($pay > $money->balance) {
            return redirect()->route('user.release_task.info', ['id' => Crypt::encrypt($id), 'wrap_type' => $wrap_type])->with('errros', '您的账户余额不足，请先充值！');
        }

        $balance = $money->balance - $pay;

        $Getid = DB::table('capital_record')->insertGetId(
            [
                'user_id' => $user_id,
                'type' => '1',
                'in_out' => '1',
                'content' => '发布任务',
                'quota' => $pay,
                'balance' => $balance,
                'ctime' => date('Y-m-d h:i:s', time())
            ]
        );

        if ($Getid) {
            $money = DB::table('task_record')
                ->where('id', '=', $id)
                ->update(['status' => '2']);
            return redirect()->route('user.release_task.info', ['id' => Crypt::encrypt($id), 'wrap_type' => $wrap_type])->with('success', '您已付款，请等待管理员审核！');
        }
    }

    public function advance(Request $request)
    {

        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $user_id = Auth::id();

            $serial = empty($request->serial) ? '' : $request->serial;
            $name = empty($request->name) ? '' : $request->name;
            $status = $request->status == 99 ? '' : $request->status;

            $builder = DB::table('task_record')
                ->where('user_id', '=', $user_id)
                ->where('wrap_type', '=', '0');

            if ($serial) {
                $builder->where('serial', 'like', '%' . $serial . '%');
            }

            if ($name) {
                $builder->where('goods_name', 'like', '%' . $name . '%');
            }

            if ($status != '') {
                $builder->where('status', '=', $status);
            }


            $total = $builder->count();
            $list = $builder->orderBy('ctime', 'desc')->offset($start)->take($length)->get()->toArray();

            $data = [
                "draw" => $draw,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $list,
            ];
            return response()->json($data);
        }

        return view('consumer/management/advance');
    }

    public function advance_task(Request $request)
    {
        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $user_id = Auth::id();

            $serial = empty($request->serial) ? '' : $request->serial;
            $alipay_order = empty($request->alipay_order) ? '' : $request->alipay_order;

            $builder = DB::table('complete_record as c')
                ->leftJoin('order_record as o', 'o.serial', '=', 'c.serial')
                ->select('c.id', 'c.serial', 'c.pic', 'c.alipay_order', 'c.fee', 'c.status', 'c.ctime')
                ->where('o.user_id', '=', $user_id);

            if ($serial) {
                $builder->where('serial', 'like', '%' . $serial . '%');
            }

            if ($alipay_order) {
                $builder->where('alipay_order', 'like', '%' . $alipay_order . '%');
            }

            $total = $builder->count();

            $list = $builder->orderBy('c.ctime', 'desc')->offset($start)->take($length)->get()->toArray();
            $data = [
                "draw" => $draw,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $list,
            ];
            return response()->json($data);
        }
        return view('consumer/management/advance_task');
    }

    public function advance_task_check(Request $request)
    {
        $id = $request->complete_id;

        $m = DB::table('brokerage_record')
            ->whereRaw('user_id=(select user_id from complete_record where id = ?)', ["$id"])
            ->orderByDesc('ctime')
            ->select('balance')
            ->first();

        $c = DB::table('complete_record as c')
            ->leftJoin('order_record as o', 'o.serial', '=', 'c.serial')
            ->select('o.price')
            ->where('c.id', '=', $id)
            ->first();
        

        if ($m) {
            $balance = $m->balance;
        } else {
            $balance = 0;
        }

        $balance1 = $balance+2;
        $balance2 = $balance1+$c->charge;

        DB::table('brokerage_record')->insert(
            [
                'user_id' => $id,
                'type' => '3',
                'in_out' => '0',
                'content' => '订单提成',
                'quota' => 2,
                'balance' => $balance1,
                'ctime' => date('Y-m-d H:i:s', time()),
            ],
            [
                'user_id' => $id,
                'type' => '5',
                'in_out' => '0',
                'content' => '任务本金返现',
                'quota' => $c->charge,
                'balance' => $balance2,
                'ctime' => date('Y-m-d H:i:s', strtotime('+1second')),
            ]
        );


        DB::table('complete_record')
            ->where('id', '=', $id)
            ->update(['status' => 1]);


        return redirect()->route('user.task')->with('success', '确认成功，订单完成');
        
    }

    function browse(Request $request)
    {
        if ($request->isMethod('post')) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $user_id = Auth::id();

            $serial = empty($request->serial) ? '' : $request->serial;
            $name = empty($request->name) ? '' : $request->name;
            $status = $request->status == 99 ? '' : $request->status;

            $builder = DB::table('task_record')
                ->where('user_id', '=', $user_id)
                ->where('wrap_type', '=', '1');

            if ($serial) {
                $builder->where('serial', 'like', '%' . $serial . '%');
            }

            if ($name) {
                $builder->where('goods_name', 'like', '%' . $name . '%');
            }

            if ($status != '') {
                $builder->where('status', '=', $status);
            }


            $total = $builder->count();
            $list = $builder->orderBy('ctime', 'desc')->offset($start)->take($length)->get()->toArray();

            $data = [
                "draw" => $draw,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $list,
            ];
            return response()->json($data);
        }
        return view('consumer/management/browse');
    }

    public function success()
    {
        return view('consumer/management/success');
    }
}
