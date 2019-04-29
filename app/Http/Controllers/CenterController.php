<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class CenterController extends Controller{
    function index(){

        $notice = DB::table('notice')->paginate(10);

        return view('consumer/center',['notice'=>$notice]);
    }
}