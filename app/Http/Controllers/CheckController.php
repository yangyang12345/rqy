<?php
namespace App\Http\Controllers;

class CheckController extends Controller{
    public function index(){
        return view('admin/check');
    }

    public function fund(){
        return view('admin/check/fund');
    }

    public function shop(){
        return view('admin/check/shop');
    }
}