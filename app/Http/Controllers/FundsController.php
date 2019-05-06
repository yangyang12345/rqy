<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FundsController extends Controller
{
    public function index(Request $request) {
        $type=$request->type;
        switch ($type){
            case 'capital':
                $capital = DB::table('capital')->paginate('15');
                return view('consumer/funds/capital',['capital'=>$capital]);
                break;
            case 'brokerage':
                return view('consumer/funds/brokerage');
                break;
        }



//
//        $demands_no_check = DB::table('demand')
//            ->leftJoin('token','demand.token_id','=','token.id')
//            ->where('demand.status','<=','1')
//            ->select('demand.id','token.nickname','demand.title','demand.created_at','demand.company_address','demand.contact')
//            ->paginate(2,['*'], 'demands_no_check');
//
//        $demands_check_fail = DB::table('demand')
//            ->leftJoin('token','demand.token_id','=','token.id')
//            ->where('demand.status','=','3')
//            ->select('demand.id','token.nickname','demand.title','demand.created_at','demand.company_address','demand.contact')
//            ->paginate(2,['*'], 'demands_check_fail');
//        return view('admin/demand',['demands'=>$demands,'demands_no_check'=>$demands_no_check,'demands_check_fail'=>$demands_check_fail]);
    }

    public function capital(Request $request){
        $start = $request->get('start');


        $builder = DB::table('users')->get()->toArray();

        $total = 3;

        $data = [];
        $data["draw"] = $request->get('draw');
        $data["recordsTotal"] = $total;
        $data["recordsFiltered"] = $total;
        $data["data"] = $builder;
        return response()->json($data);



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

