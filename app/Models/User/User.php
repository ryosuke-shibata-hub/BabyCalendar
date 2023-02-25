<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
use Hash;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public $timestamps = false;

    protected $dates = [
        'create_date',
        'update_date',
        'delete_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'account_uuid',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public static function UserMypage($login_id)
    {
        return self::select(
            'id',
            'logo',
            'background_logo',
            'account_name',
            'comment',
            'account_uuid',
            'login_id',
        )
        ->where('login_id',$login_id)
        ->where('delete_flg',0)
        ->first();
    }

    public static function UserEditProfile($account_uuid)
    {
        return self::select(
            'id',
            'logo',
            'background_logo',
            'account_name',
            'comment',
            'account_uuid',
            'login_id',
            'email'
        )
        ->where('account_uuid',$account_uuid)
        ->where('delete_flg',0)
        ->first();
    }

    public static function checkUniqueAccountName($accountName,$accountUuid)
    {
        return self::select(
            'account_name',
        )
        ->where('account_name', $accountName)
        ->where('account_uuid','!=',$accountUuid)
        ->where('delete_flg',0)
        ->first();
    }

    public static function checkUniqueEmail($accountEmail,$accountUuid)
    {
        return self::select(
            'email',
        )
        ->where('email', $accountEmail)
        ->where('account_uuid','!=',$accountUuid)
        ->where('delete_flg',0)
        ->first();
    }

    public static function updateProfile($request,$authUuid,$myLogoPath,$myBackgroundLogoPath)
    {
        $data =  User::where('account_uuid',$authUuid)->first();
        $data->account_name = $request->accountName;
        $data->comment = $request->myComment;
        $data->logo = $myLogoPath;
        $data->background_logo = $myBackgroundLogoPath;
        $data->update_date = now();
        $data->save();

        return $data;
    }

    public static function deleteAccount($authUuid)
    {
        $data = User::where('account_uuid',$authUuid)
        ->where('delete_flg',config('const.User.Active.Active'))->first();
        $data->delete_flg = config('const.User.Active.Disable');
        $data->update_date = now();
        $data->delete_date = now();
        $data->save();

        return $data;
    }

    public static function editEmail($authUuid,$accountEmail)
    {
        $data = User::where('account_uuid',$authUuid)
        ->where('delete_flg',config('const.User.Active.Active'))->first();
        $data->email = $accountEmail;
        $data->update_date = now();
        $data->save();

        return $data;
    }

    public static function editPassword($authUuid,$newPassword)
    {
        $data = User::where('account_uuid',$authUuid)
        ->where('delete_flg',config('const.User.Active.Active'))->first();
        $data->password = Hash::make($newPassword);
        $data->update_date = now();
        $data->save();

        return $data;
    }

    public static function getImageLists($userId)
    {
        return self::select(
            'images.image_path as image',
            'images.create_date as createDate',
            'users.login_id as loginId',
            'users.account_uuid as uuid',
        )
        ->leftJoin('images', 'users.account_uuid', 'images.account_uuid')
        ->where('users.delete_flg', '=', 0)
        ->where('images.delete_flg', '=', 0)
        ->get();
    }
}
