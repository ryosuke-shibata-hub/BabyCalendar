<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User\User;

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
        dd($request);
        $validator = Validator::make($request->all(), [
            'userId' => ['bail','required'],
            'files.*.upload_image'  => ['bail','required','image','max:5000'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/show/image')
            ->withErrors($validator)
            ->withInput();
        }
    }
}
