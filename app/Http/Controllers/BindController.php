<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation;


class BindController extends Controller{
    function index(){
        return view('consumer/bind');
    }

    function list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = DB::table('shop');

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

    public function shop(Request $request){
        $user_id = $request->id;
        $shop_type = $request->shop_type;
        $store_name = $request->store_name;
        $wangwang = $request->wangwang;
        $gap_day = $request->gap_day;
        $store_url = $request->store_url;
        $province = $request->province;
        $city = $request->city;
        $district = $request->district;
        $addr = $request->addr;
        $tel = $request->tel;

        $file = $request->file('pic');

        if (strpos($store_url,'http') === false){
            $store_url = 'http://'.$store_url;
        }

        // 文件是否上传成功
        if ($file->isValid()) {

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

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



        $Getid = DB::table('shop')->insertGetId(
            [
                'user_id' => $user_id,
                'type' => $shop_type,
                'store_name' => $store_name,
                'wangwang' => $wangwang,
                'gap_day' => $gap_day,
                'url'=> $store_url,
                'province'=>$province,
                'city'=>$city,
                'district'=>$district,
                'street'=>$addr,
                'tel'=>$tel,
                'photo'=>$photo,
                'status'=>'0', //0 表示审核中
                'ctime'=>date('Y-m-d h:i:s',time())
            ]
        );

        if ($Getid){
            return redirect()->route('user.bind')->with('success','店铺绑定成功');
        }
    }
}