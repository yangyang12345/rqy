<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/center';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'tel';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }

    //重写父类的credentials方法，只允许商家登录,商家type为1
    protected function credentials(Request $request){
        $credentials = $request->only($this->username(), 'password');
        $credentials['type'] = 1;
        return $credentials;
    }

    //登录添加验证码
//    protected function validateLogin(Request $request){
//        $this->validate($request, [
//            $this->username() => 'required',
//            'password' => 'required',
//            'captcha' => 'required|captcha',
//        ],[
////            'captcha.required' => trans('validation.required'),
////            'captcha.captcha' => trans('validation.captcha'),
//            'captcha.required' => '请填写验证码',
//            'captcha.captcha' => '验证码错误',
//
//        ]);
//    }
}
