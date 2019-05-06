<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller{
    public function index(){
        return view('admin/check');
    }

    public function fund(){
        return view('admin/check/fund');
    }

    public function fund_list(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = DB::table('charge_record');

        $total = $builder->count();
        $list = $builder->orderBy('ctime', 'desc')->offset($start)->take($length)->get()->toArray();

        $data = [
            "draw"=>$draw,
            "recordsTotal"=>$total,
            "recordsFiltered"=>$total,
            "data"=>$list,
        ];
        return response()->json($data);
    }

    public function shop(){
        return view('admin/check/shop');
    }
}