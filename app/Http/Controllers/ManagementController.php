<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller{
    function task(){
        $user_id = Auth::id();
        $shops = DB::table('shop')
            ->where('user_id','=',$user_id)
            ->get();
        return view('consumer/task',['shops'=>$shops]);
    }

    function advance(){
        return view('consumer/advance');
    }

    function browse(){
        return view('consumer/browse');
    }
}