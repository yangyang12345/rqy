<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PlanController extends Controller{
    function index(){
        return view('consumer/plan');
    }
}