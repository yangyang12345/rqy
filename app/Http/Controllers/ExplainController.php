<?php
namespace App\Http\Controllers;

class ExplainController extends Controller{
    function index(){
        return view('admin/explain');
    }

    function push(){
        return view('admin/explain_push');
    }
}