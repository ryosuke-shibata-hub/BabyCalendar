<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
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
}
