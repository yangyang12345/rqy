<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation;
use Illuminate\Support\Facades\Hash;

/**
 * 手机端接口，目前保证能用，不做其他处理
 */

class ApiController extends Controller{


    /**
     * 登录
     */
    public function app_login(Request $request){
        $tel = $request->tel;
        $password = $request->password;
        if(!$tel || !$password){
            return response()->json('参数错误');
        }
        
        $t = DB::table('users')->where('tel','=',$tel)->get();
        if(!$t->count()){
            return response()->json('账号错误');
        }

        $p = DB::table('users')
        ->where('tel','=',$tel)
        ->select('password')
        ->first();

        if(!Hash::check($password,$p->password)){
            return response()->json('密码错误');
        }

        return response()->json('scuccess');
    }

    /**
     * 注册
     */
    public function app_register(Request $request){
        $tel = $request->tel;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $qq = $request->qq;
        $wx = $request->wx;
        $sex = $request->sex;
        $type = '0';
        $ctime = date('Y-m-d H:i:s',time());

        $t = DB::table('users')->where('tel','=',$tel)->get();
        if(!$t->count()){
            return response()->json('此账号已被注册，请重新选择');
        }

        $Getid = DB::table('users')->insertGetId(
            [
                'tel'=>$tel,
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'qq' => $qq,
                'wx' => $wx,
                'sex' => $sex,
                'type' => $type,
                'created_at' => $ctime,
                'updated_at' => $ctime
            ]
        );

        if ($Getid){
            return response()->json('scuccess');
        }
    }

    /**
     * 重置密码
     */
    public function reset_password(Request $request){
        $tel = $request->tel;
        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $res = DB::table('users')
        ->where('tel','=',$tel)
        ->select('password')
        ->first();

        if(!Hash::check($old_password, $res->password)){
            return response()->json('原密码错误');
        }
        $update = array(
          'password'  =>Hash::make($new_password),
        );
        $result = DB::table('users')
        ->where('tel',$tel)
        ->update($update);

        if($result){
            return response()->json('success');
        }else{
            return response()->json('修改失败，请重试');
        }



    }

    /**
     * 任务列表
     */
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