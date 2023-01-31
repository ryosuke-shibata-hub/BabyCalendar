<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

use App\Models\User\FamilyList;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }


    public function create(Request $request)
    {
// dd($request);
    try {
        // foreach ($request as $key => $value) {
            DB::beginTransaction();

            FamilyList::CreateNewFamily($request);

            DB::commit();
        // }
        return redirect()->back()->with('sucsess','成功');
        } catch (\Throwable $th) {
            return redirect()->back()->with('sucsess','しっぱい');
        }

    }

    public function test(Request $request)
    {
        // dd($request);
        $requestList = $request->only(['name']);
        // dd($requestList);
        foreach ($requestList as $key => $value) {
            $list = FamilyList::select($value);
        }

        Log::debug('ここよ',[$list]);

        dd($list);
    }
}