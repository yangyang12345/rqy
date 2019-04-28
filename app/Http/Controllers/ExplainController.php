<?php
namespace App\Http\Controllers;

class ExplainController extends Controller{
    function index(){
        return view('consumer/explain');
    }

    function push(){
        return view('consumer/explain_push');
    }
}