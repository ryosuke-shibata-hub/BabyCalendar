<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function showMypage(Request $request)
    {
        $id = $request->id;
        return view('User.show_mypage')
        ->with('id',$id);
    }
}
