<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index() {


//        $tokens = App\token::paginate(15);
        $tokens = DB::table('token')->paginate(15);

        $count_all = DB::table('token')->count();

        $count_today = DB::select('SELECT count(*) as count_today FROM token WHERE DATEDIFF(created_at,NOW())=0');

        $count_month = DB::select('SELECT count(*) as count_month FROM token WHERE DATEDIFF(created_at,NOW())<=0 AND DATEDIFF(created_at,NOW())>-30');

        $count_active = DB::select('SELECT count(*) as count_active FROM token WHERE DATEDIFF(updated_at,NOW())=0');

        $count=array(
            'count_all' => $count_all,
            'count_today' => $count_today[0]->count_today,
            'count_month' => $count_month[0]->count_month,
            'count_active' => $count_active[0]->count_active,
        );

        return view('admin/user',['tokens'=>$tokens,'count'=>$count]);
    }

    public function doc(){
        return redirect('api/documentation');
    }
}
