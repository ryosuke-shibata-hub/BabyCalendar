<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hash;

use App\Models\User\User;


class Register extends Model
{
    use HasFactory;

    public static function storeAccount($request)
    {
        $delete_flg = config('const.User.Active.Active');
        $default_logo = config('const.User.ImagePath.Default.Logo');
        $default_background_logo = config('const.User.ImagePath.Default.BackgroundLogo');
        $roll = config('const.User.Roll.GeneralUser');

        $data = new User();
        $data->account_uuid = (string) Str::uuid();
        $data->account_name = $request->accountName;
        $data->login_id = $request->loginId;
        $data->background_logo = $default_background_logo;
        $data->logo = $default_logo;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->delete_flg = $delete_flg;
        $data->user_roll = $roll;
        $data->create_date = now();
        $data->update_date = now();
        $data->save();
    }
}
