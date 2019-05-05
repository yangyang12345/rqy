<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargeController extends Controller{

    public function index(){
        return view('consumer/charge');
    }


    /*
     * 用于支付宝微信充值
     */
    public function online(Request $request){

    }

    /*
     * 用于银行转账
     * type::
     */
    public function bank(Request $request){
        $id = $request->id;

    }
}