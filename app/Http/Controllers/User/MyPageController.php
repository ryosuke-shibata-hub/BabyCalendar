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
        $id = $request->id;
        $userInformation = User::MyContent($id);

        return view('User.show_mypage')
        ->with('id',$id)
        ->with('userInformation', $userInformation);
    }

    public function editProfile($id)
    {
        $userInformation = User::MyContent($id);
        return view('User.editProfile')
        ->with('userInformation', $userInformation);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accountName' => ['bail','required','string','max:16'],
            'myComment' => ['bail','string','max:200',],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/edit/profile/'.$request->accountUuid)
            ->withErrors($validator)
            ->withInput();
        }
        $accountUuid = $request->accountUuid;
        $authUuid = Auth::user()->account_uuid;
        $accountName = $request->accountName;
        $checkUnique = User::checkUniqueAccountName($accountName,$accountUuid);

        if (!empty($checkUnique)) {
            return redirect('/FirstBaby/edit/profile/'.$request->accountUuid)
            ->with('err_message','入力されたアカウントネームは既に存在します。別のアカウントネームを入力してください。');
        }
        if ($accountUuid !== $authUuid) {
            Log::error("アカウント更新で不正なリクエスト",['認証UUID',$accountUuid,'リクエストUUID',$accountUuid]);
        }

        try {

            DB::beginTransaction();

            User::updateProfile($request,$authUuid);

            DB::commit();

            return redirect('/FirstBaby/edit/profile/'.$request->accountUuid)
            ->with('succsess_msg',"アカウント情報の更新が完了しました。");

        } catch (\Throwable $th) {
            Log::error("アカウント更新で例外処理発生",['アカウントUUID',$accountUuid,$th]);
            return redirect('/FirstBaby/edit/profile/'.$request->accountUuid)
            ->with('err_message','更新処理に失敗しました。更新操作を再度お試しください');
        }
    }
}
