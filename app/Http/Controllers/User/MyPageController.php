<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User\User;

use Hash;
use DB;
use Log;

class MyPageController extends Controller
{
    public function showMypage(Request $request)
    {
        $login_id = $request->id;
        $userInformation = User::UserMypage($login_id);
        $defaltBackgroundImg = "/image/defaultBackground.jpeg";
        $defaltLogoImg = "/image/defaultLogo.jpg";

        return view('User.show_mypage')
        ->with('id',$login_id)
        ->with('userInformation', $userInformation)
        ->with('defaltBackgroundImg', $defaltBackgroundImg)
        ->with('defaltLogoImg',$defaltLogoImg);
    }

    public function editProfile(Request $request)
    {
        $account_uuid = Auth::user()->account_uuid;
        $userInformation = User::UserEditProfile($account_uuid);

        return view('User.editProfile')
        ->with('userInformation', $userInformation);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accountName' => ['bail','required','string','max:16'],
            'myComment' => ['bail','string','max:200',],
            'myLogo' => ['bail','image','max:5000'],
            'myBackgroundLogo' => ['bail','image','max:5000'],
            'password'    => ['required','current_password'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/edit/profile')
            ->withErrors($validator)
            ->withInput();
        }

        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;
        $accountName = $request->accountName;
        $checkUnique = User::checkUniqueAccountName($accountName,$accountUuid);
        $myLogo = $request->file('myLogo');
        $myBackgroundLogo = $request->file('myBackgroundLogo');

        if (!empty($checkUnique)) {
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','入力されたアカウントネームは既に存在します。別のアカウントネームを入力してください。');
        }
        if ($accountUuid !== $authUuid) {
            Log::error("アカウント更新で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
        }

        try {

            DB::beginTransaction();

            if ($myLogo) {
                $myLogoPath = '/'.$myLogo->store('/public/image/Profile/Logo','public');
            } else {
                $myLogoPath = Auth::user()->logo;
            }
            if ($myBackgroundLogo) {
                $myBackgroundLogoPath = '/'.$myBackgroundLogo->store('/public/image/Profile/Logo','public');
            } else {
                $myBackgroundLogoPath = Auth::user()->background_logo;
            }

            User::updateProfile($request,$authUuid,$myLogoPath,$myBackgroundLogoPath);

            DB::commit();

            return redirect('/FirstBaby/edit/profile')
            ->with('succsess_msg',"アカウント情報の更新が完了しました。");

        } catch (\Throwable $th) {
            Log::error("アカウント更新で例外処理発生",['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','更新処理に失敗しました。更新操作を再度お試しください');
        }
    }

    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_uuid' => ['bail','required','string','max:50','exists:users'],
            'password'    => ['required','current_password'],
        ]);
        if ($validator->fails()) {
            Log::error("アカウント削除で例外処理発生(不正なリクエスト、存在しないUUID)",['リクエストUUID',$request->account_uuid]);
            return redirect(404);
        }

        $authUuid = Auth::user()->account_uuid;
        $requestUuid = $request->account_uuid;
        if ($authUserUuid !== $requestUuid) {
            Log::error("アカウント削除で例外処理発生(不正なリクエスト、認証ユーザーと異なるuuid)",['リクエストUUID',$request->account_uuid]);
            return redirect(404);
        }

        try {
            DB::beginTransaction();
            User::deleteAccount($authUuid);
            DB::commit();

            //アカウント削除後にログアウト処理
            $logout_user = Auth::id();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::info("アカウント削除、ログアウト処理成功",[$logout_user]);
            return redirect('/FirstBaby/delete/account/confirm')
            ->with('succsess_msg',"アカウントの削除が完了しました。");

        } catch (\Throwable $th) {
            Log::error("アカウント削除で例外処理発生",['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','アカウントの削除に失敗しました。更新操作を再度お試しください');
        }
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['bail','required','string','max:50','email'],
            'use_notification'  => ['bail','required','string','max:1'],
            'password'    => ['required','current_password'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/edit/profile')
            ->withErrors($validator)
            ->withInput();
        }

        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;
        $accountEmail = $request->email;
        $checkUnique = User::checkUniqueEmail($accountEmail,$accountUuid);

        if (!empty($checkUnique)) {
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','入力されたメールアドレスは既に存在します。別のメールアドレスを入力してください。');
        }
        if ($accountUuid !== $authUuid) {
            Log::error("アカウント更新で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
        }

        try {
            DB::beginTransaction();
            User::editEmail($authUuid,$accountEmail);
            DB::commit();

            Log::info("アカウント更新(登録メールアドレス)完了",[$authUuid]);
            return redirect('/FirstBaby/edit/profile')
            ->with('succsess_msg',"アカウント情報の更新が完了しました。");

        } catch (\Throwable $th) {
            Log::error("アカウント更新(登録メールアドレス)で例外処理発生",['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','アカウントの更新に失敗しました。更新操作を再度お試しください');
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'    => ['bail','required','current_password'],
            'newPassword' => ['bail','required',
            'regex:/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i',
            ],
            'passwordConfirm' => ['bail','required','same:newPassword'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/edit/profile')
            ->withErrors($validator)
            ->withInput();
        }
        //新しいパスワードと現在のパスワードの値チェック
        if(Hash::check($request->newPassword, Auth::user()->password)){
            return back()->with('err_message','※新しいパスワードには現在のパスワードと違うパスワードを設定してください。');
        }
        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;
        $newPassword = $request->newPassword;

        if ($accountUuid !== $authUuid) {
            Log::error("アカウント更新で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
            return redirect(404);
        }

        try {
            DB::beginTransaction();
            User::editPassword($authUuid,$newPassword);
            DB::commit();

            Log::info("アカウント更新(パスワード更新)完了",[$authUuid]);
            return redirect('/FirstBaby/edit/profile')
            ->with('succsess_msg',"アカウント情報の更新が完了しました。");

        } catch (\Throwable $th) {
            Log::error("アカウント更新(パスワード更新)で例外処理発生",['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','アカウントの更新に失敗しました。更新操作を再度お試しください');
        }
    }
}
