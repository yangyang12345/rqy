<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller{
    public function index(){
        return view('admin/notice');
    }

    public function store(Request $request){
        $content = $request->editor;
        $title = $request->title;
        $type = $request->type;
        $time = date('Y-m-d h:i:s',time());
        $user_id = Auth::id();

//        Log::info('User failed to login.', ['id' => $content]);

        $rules = [
            'title' => 'required',
            'editor' => 'required',
        ];

        //定义提示信息
        $messages = [
            'title.required' => '请填写公告标题',
            'editor.required' => '请填写公告内容',
        ];

        //创建验证器
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/notice')
                ->withErrors($validator)
                ->withInput();
        }

        $id = DB::table('notice')->insertGetId(
            [
                'user_id'=>$user_id,
                'title' => $title,
                'content' =>$content,
                'type' => $type,
                'time'=>$time
            ]
        );

        if ($id){
            return view('consumer/notice');
        }
    }

    public function show(){
        $notice = DB::select('select * from notice where id = :id', ['id' => 6]);

        return view('consumer/notice',['notice'=>$notice]);
    }

    public function upload(Request $request){
//        $request_all = $request->all();

        if ($request->isMethod('post')) {

            $file = $request->file('upload');
            $callback = $request->get('CKEditorFuncNum');

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

//                Log::info('file:',$type);

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));

                $previewname = '/public/uploads/'.$filename;//就是很简单的一个步骤

//                $callback = $_REQUEST["CKEditorFuncNum"];

                Log::info('file:',['bool'=>$callback]);
                echo "<script type='text/javascript'>alert('上传成功')</script>";
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,$previewname,'上传成功');</script>";

            }

        }
    }

}