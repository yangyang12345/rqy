<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller{

    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();

            return $next($request);
        });
    }

    public function index(){

        $id = Auth::id();

        $charges = DB::table('charge_record')
            -> where('user_id', '=', $id)
            -> orderBy('ctime','desc')
            -> take(5)
            -> get();
        return view('consumer/charge',['charges'=>$charges]);
    }


    /*
     * 用于支付宝微信充值
     * type::0
     */
    public function online(Request $request){
        $id = $request->id;
        $online_type = $request->online_type;
        $online_code = $request->online_code;
        $nick_name = $request->nick_name;
        $money = $request->online_money;

        $Getid = DB::table('charge_record')->insertGetId(
            [
                'user_id' => $id,
                'account' => $online_code,
                'account_name' => $nick_name,
                'fund' => $money,
                'type' => '0',
                'charge_type'=>$online_type,
                'status'=>'0',
                'ctime'=>date('Y-m-d h:i:s',time())
            ]
        );

        if ($Getid){
            return redirect()->route('charge')->with('success','充值成功，请耐心等待客服审核，审核通过后到账，请勿重复提交');
        }
    }

    /*
     * 用于银行转账
     * type::1
     */
    public function bank(Request $request){
        $id = $request->id;
        $bank_type = $request->bank_type;
        $bank_code = $request->bank_code;
        $true_name = $request->true_name;
        $money = $request->money;

        $Getid = DB::table('charge_record')->insertGetId(
            [
                'user_id' => $id,
                'account' => $bank_code,
                'account_name' => $true_name,
                'fund' => $money,
                'type' => '1',
                'charge_type'=>$bank_type,
                'status'=>'0',
                'ctime'=>date('Y-m-d h:i:s',time())
            ]
        );

        if ($Getid){
            return redirect()->route('charge')->with('success','充值成功，请耐心等待客服审核，审核通过后到账，请勿重复提交');
        }
    }
}