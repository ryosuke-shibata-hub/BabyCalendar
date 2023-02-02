<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FamilyList extends Model
{
    use HasFactory;

    public static function CreateNewFamily($request)
    {
        $user_id = Auth::id();
        $flg=0;
        $i = 0;

        foreach ($request->num as $val) {
            $new_family = new FamilyList;
            $new_family->user_id = $user_id;
            $new_family->baby_name = $request->name[$i];
            $new_family->baby_age = $request->age[$i];
            $new_family->baby_sex = $request->sex[$i];
            $new_family->logo = '';
            $new_family->delete_flg = $flg;
            // dd($new_family);
            $new_family->save();
            $i++;
        }


    }

    public static function select($value)
    {
        // dd($value);
        return self::whereIn('id',$value)
            ->get();


    }



}