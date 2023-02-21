<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User\User;

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

    // public function editAccount(Request $request)
    // {
    //     $account_uuid = Auth::user()->account_uuid;
    //     $userInformation = User::UserEditProfile($account_uuid);

    //     return view('User.editProfile')
    //     ->with('userInformation', $userInformation);
    // }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accountName' => ['bail','required','string','max:16'],
            'myComment' => ['bail','string','max:200',],
            'myLogo' => ['bail','image','max:5000'],
            'myBackgroundLogo' => ['bail','image','max:5000'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/edit/profile')
            ->withErrors($validator)
            ->withInput();
        }

        $accountUuid = $request->accountUuid;
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
            Log::error("アカウント更新で不正なリクエスト",['認証UUID',$accountUuid,'リクエストUUID',$accountUuid]);
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
            Log::error("アカウント更新で例外処理発生",['アカウントUUID',$accountUuid,$th]);
            return redirect('/FirstBaby/edit/profile')
            ->with('err_message','更新処理に失敗しました。更新操作を再度お試しください');
        }
    }


}
