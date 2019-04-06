<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DemandController extends Controller
{
    public function index() {

        $demands = DB::table('demand')
            ->leftJoin('token','demand.token_id','=','token.id')
            ->select('demand.id','token.nickname','demand.type','demand.title','demand.status','demand.company_address','demand.contact')
            ->paginate('15',['*'], 'demands');

        $demands_no_check = DB::table('demand')
            ->leftJoin('token','demand.token_id','=','token.id')
            ->where('demand.status','<=','1')
            ->select('demand.id','token.nickname','demand.title','demand.created_at','demand.company_address','demand.contact')
            ->paginate(2,['*'], 'demands_no_check');

        $demands_check_fail = DB::table('demand')
            ->leftJoin('token','demand.token_id','=','token.id')
            ->where('demand.status','=','3')
            ->select('demand.id','token.nickname','demand.title','demand.created_at','demand.company_address','demand.contact')
            ->paginate(2,['*'], 'demands_check_fail');
        return view('admin/demand',['demands'=>$demands,'demands_no_check'=>$demands_no_check,'demands_check_fail'=>$demands_check_fail]);
    }

    public function detail($id){
        $demand = DB::table('demand')
            ->leftJoin('token','demand.token_id','=','token.id')
            ->where('demand.id','=',$id)
            ->get();
        return view('admin/demand/detail',['demand'=>$demand]);
    }

    public function check(Request $request){
        $id=$request->only('id');
        $demand = DB::table('demand')
            ->leftJoin('token','demand.token_id','=','token.id')
            ->where('demand.id','=',$id)
            ->get();
        return $demand;
    }
}

