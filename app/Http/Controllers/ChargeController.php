<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller{

    protected $user;

    protected $bank_name = [
        '1'=>'中国建设银行',
        '2'=>'中国工商银行',
        '3'=>'中国农业银行',
        '4'=>'中国银行',
        '5'=>'中国邮政储蓄银行',
        '6'=>'招商银行',
        '7'=>'平安银行',
        '8'=>'民生银行',
        '9'=>'交通银行',
        '10'=>'光大银行',
        '11'=>'中信银行',
        '12'=>'中信银行',
        '13'=>'兴业银行',
        '14'=>'上海浦东发展银行',
        '15'=>'其他银行',
    ];

    protected $online_name = [
        '1'=>'支付宝',
        '2'=>'微信'
    ];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();

            return $next($request);
        });

    }

    public function index(){

        $user_id = Auth::id();

        $charges = DB::table('charge_record')
            -> where('user_id', '=', $user_id)
            -> orderBy('ctime','desc')
            -> take(5)
            -> get();

        $capital = DB::table('capital_record')
            ->where('user_id','=',$user_id)
            ->orderByDesc('ctime')
            ->first();

        return view('consumer/charge',['charges'=>$charges,'capital'=>$capital]);
    }


    /*
     * 用于支付宝微信充值
     * type::0
     */
    public function online(Request $request){
        $id = $request->id;
        // $online_type = $request->online_type;
        $online_type = 1;
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
                'charge_type_name'=>$this->online_name[$online_type],
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
                'charge_type_name'=>$this->bank_name[$bank_type],
                'status'=>'0',
                'ctime'=>date('Y-m-d h:i:s',time())
            ]
        );

        if ($Getid){
            return redirect()->route('charge')->with('success','充值成功，请耐心等待客服审核，审核通过后到账，请勿重复提交');
        }
    }
}