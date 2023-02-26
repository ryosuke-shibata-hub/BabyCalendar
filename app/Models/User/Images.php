<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $dates = [
        'create_date',
        'update_date',
        'delete_date',
    ];

    public static function upload($myImagePath,$authUuid)
    {
        $data = new Images();
        $data->account_uuid = $authUuid;
        $data->image_path = $myImagePath;
        $data->delete_flg = config('const.User.Active.Active');
        $data->create_date = now();
        $data->update_date = now();
        $data->save();

        return $data;
    }

    public static function deleteImage($authUuid,$e)
    {
        $data = Images::where('account_uuid',$authUuid)
        ->where('image_path',$e)
        ->where('delete_flg',config('const.User.Active.Active'))
        ->first();

        $data->delete_flg = config('const.User.Active.Disable');
        $data->update_date = now();
        $data->delete_date = now();
        $data->save();

        return $data;
    }

    public static function downloadImg($authUuid,$e)
    {
        return self::where('account_uuid',$authUuid)
        ->where('image_path',$e)
        ->where('delete_flg',config('const.User.Active.Active'))
        ->first();
    }
}
