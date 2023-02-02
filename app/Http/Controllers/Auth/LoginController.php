<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User\User;

use Log;


class LoginController extends Controller
{

    public function username()
    {
        //ログインに使うフィールド名を設定する
        return 'loginId';
    }
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {

        $delete_flg = config('const.User.Active.Active');
        $credentials = $request->validate([
            'loginId' => ['required'],
            'password' => ['required'],
        ]);

        // try {
            if (Auth::attempt([
                'login_id' => $request->input('loginId'),
                'password' => $request->input('password'),
                'delete_flg' => $delete_flg,
            ])) {
                $request->session()->regenerateToken();
                $request->session()->regenerate();
                Log::info("ログイン成功");

                return redirect('/FirstBaby/test');
            }

            return redirect('/FirstBaby/login')->with('errmessage','*ログインIDまたはパスワードが違います。');
        // } catch (\Throwable $th) {
        //     Log::error("例外処理発生");
        // }

    }
}