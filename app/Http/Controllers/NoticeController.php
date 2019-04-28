<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function upload(){
        $extensions = array("jpg","bmp","gif","png");
        $uploadFilename = $_FILES['upload']['name'];

        $uploadFilesize = $_FILES['upload']['size'];
        if($uploadFilesize  > 1024*2*1000){
            echo "<font color=\"red\"size=\"2\">*图片大小不能超过2M</font>";
            exit;
        }

        $extension = pathInfo($uploadFilename,PATHINFO_EXTENSION);
        Log::info('User failed to login.', ['id' => $extension]);

        if(in_array($extension,$extensions)){
            $uploadPath ="./uploadfile/";
            $uuid = str_replace('.','',uniqid("",TRUE)).".".$extension;

            $desname = $uploadPath.$uuid;

            $previewname = './uploadfile/'.$uuid;
            $tag = move_uploaded_file($_FILES['upload']['tmp_name'],$desname);
            $callback = $_REQUEST["CKEditorFuncNum"];
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,'".$previewname."','');</script>";
        }else{
            echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为.jpg/.gif/.bmp/.png文件）</font>";
        }
    }

}