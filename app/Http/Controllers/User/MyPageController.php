<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User\User;

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
}
