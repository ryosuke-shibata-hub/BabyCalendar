<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User\User;
use App\Models\User\Images;

use STS\ZipStream\ZipStreamFacade AS Zip;

use Log;
use DB;
class ShowImageController extends Controller
{
    public function showImages(Request $request)
    {

        $userId = Auth::user()->account_uuid;
        $showUserImage = User::getImageLists($userId);

        return view('User.show_images')
        ->with('showUserImage', $showUserImage)
        ->with('userId', $userId);
    }

    public function uploadImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_uuid' => ['bail','required'],
            'files.*.upload_image'  => ['bail','required','image','max:5000'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/show/image')
            ->withErrors($validator)
            ->withInput();
        }

        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;

        if ($accountUuid !== $authUuid) {
            Log::error("画像アップロードで不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
            return redirect(404);
        }

        try {

            DB::beginTransaction();

            foreach ($request->file('files') as $index => $e) {

                //画像アップ枚数は50枚の制限

                $myImagePath = '/'.$e['upload_image']->store($this->myImagePath, 'public');
                Images::upload($myImagePath,$authUuid);
            }

            DB::commit();

            return redirect('/FirstBaby/show/image')
            ->with('succsess_msg','画像のアップロードが完了しました。');

        } catch (\Throwable $th) {
            Log::error("画像アップロードで例外処理発生", ['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/show/image')
            ->with('err_message', 'アップロードに失敗しました。操作を再度お試しください');
        }
    }

    public function editImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_uuid' => ['bail','required'],
            'check_img'  => ['bail','required'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/show/image')
            ->withErrors($validator)
            ->withInput();
        }

        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;

        if ($accountUuid !== $authUuid) {
            Log::error("画像更新で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
            return redirect(404);
        }

        try {

            if ($request->has('delete_image')){
                DB::beginTransaction();
                Log::info("画像の削除");
                foreach ($request->check_img as $index => $e) {
                    //DBの中でdelete_flgを立てる
                    Images::deleteImage($authUuid,$e);
                    //画像を物理削除は一旦置いておく
                }
                DB::commit();

                return redirect('/FirstBaby/show/image')
                ->with('succsess_msg','画像の削除が完了しました。');
            }elseif ($request->has('download_image')){
                Log::info("画像のダウンロード");

                $name = sprintf("%02d", "1");
                $filePath = [];
                $downloadDir = storage_path().config('const.Images.Download.Zip');
                foreach ($request->check_img as $index => $e) {
                    $targetImg = Images::downloadImg($authUuid,$e);

                    $filePath[] = storage_path().config('const.Images.Download.MyImg').$targetImg->image_path;

                    // $fileName = 'FirstBaby_'.$name++;
                    // $mimeType = Storage::mimeType($targetImg->image_path);
                    // $header = [['Content-Type' => $mimeType]];
                }

                $zipFileName = 'FirstBabyDownload.zip';
                Zip::create($zipFileName, $filePath)
                ->saveTo($downloadDir . '/zip');

                $fullPath = $downloadDir . '/zip/' . $zipFileName;

                return response()->download($fullPath, basename($fullPath), [])->deleteFileAfterSend(true);
            }
        } catch (\Throwable $th) {
            Log::error("画像編集で例外処理発生", ['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/show/image')
            ->with('err_message', '画像の編集処理に失敗しました。操作を再度お試しください');
        }
    }
}
