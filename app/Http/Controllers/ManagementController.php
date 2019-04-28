<?php

namespace App\Http\Controllers;

class ManagementController extends Controller{
    function task(){
        return view('consumer/task');
    }

    function advance(){
        return view('consumer/advance');
    }

    function browse(){
        return view('consumer/browse');
    }
}