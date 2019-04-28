<?php

namespace App\Http\Controllers;

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

        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];

        //定义提示信息
        $messages = [
            'title.required' => '请填写公告标题',
            'content.required' => '请填写公告内容',
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

    function show(){
        $notice = DB::select('select * from notice where id = :id', ['id' => 1]);

        return view('consumer/notice',['notice'=>$notice]);
    }

}