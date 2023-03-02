<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class QuestionBox extends Model
{
    use HasFactory;
    protected $table = 'question_boxes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function QuestionList()
    {
        $data = self::select(
            'title',
            'post_uuid',
            'body',
            'view_counter',
            'question_boxes.updated_at as updated_at',
            'users.logo as logo',
            'users.login_id as login_id',
            'users.account_name as user_name'
        )
        ->where('question_boxes.delete_flg', config('const.QuestionBox.Active.Active'))
        ->where('users.delete_flg', config('const.User.Active.Active'));

        $data = $data
        ->leftJoin('users','question_boxes.user_id', '=', 'users.id')
        ->get();

        return $data;
    }
}
