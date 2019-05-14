<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller{
    function index(){
        $user_id = Auth::id();

        $invite_count = DB::table('invite')
            ->where('inviter','=',$user_id)
            ->count('id');
//        dd($count);
        return view('consumer/plan',['invite_count'=>$invite_count]);
    }
}