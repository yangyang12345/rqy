<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StatisticsController extends Controller{
    function index(){
        return view('admin/statistics');
    }
}