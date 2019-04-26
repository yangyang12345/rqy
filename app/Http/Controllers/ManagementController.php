<?php

namespace App\Http\Controllers;

class ManagementController extends Controller{
    function task(){
        return view('admin/task');
    }

    function advance(){
        return view('admin/advance');
    }

    function browse(){
        return view('admin/browse');
    }
}