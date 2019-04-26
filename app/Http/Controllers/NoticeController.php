<?php

namespace App\Http\Controllers;

class NoticeController extends Controller{
    public function index(){
        return view('admin/notice');
    }
}