<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Auth\Register;

use Log;
class RegisterController extends Controller
{
    public function create()
    {
        return view('Auth.register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'loginId' => ['bail','required','regex:/^[a-zA-Z0-9-_]+$/','min:8','max:16','string','unique:users,login_id'],
            'email' => ['bail','required','email:rfc','string','unique:users,email'],
            'accountName' => ['bail','required','string','unique:users,account_name','max:16'],
            'password' => [
                'regex:/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i','string','bail','required'],
            'passwordConfirm' => [
                'bail','required','string','same:password'],
        ]);
        try {
            //アカウント登録
            Register::storeAccount($request);

            $accountName = $request->accountName;
            session()->put('accountName', $accountName);

            return redirect('/FirstBaby/register/confirm')
            ->with('accountName',$accountName);

        } catch (\Throwable $th) {
            Log::error("例外処理発生",["新規登録時リクエスト"=>$request,"エラー詳細"=>$th]);
            return redirect(500);
        }
    }

    public function confirm(Request $request)
    {
        return view('Auth.registerConfirm');
    }
}
