<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
            'question_boxes.question_uuid',
            'body',
            'view_counter',
            'question_boxes.updated_at as updated_at',
            'users.logo as logo',
            'users.login_id as login_id',
            'users.account_name as user_name',
            'tags.question_uuid',
            'tags.tag_name as tags',
            'tags.tag_id',
        )
        ->where('question_boxes.delete_flg', config('const.QuestionBox.Active.Active'))
        ->where('users.delete_flg', config('const.User.Active.Active'))
        ->where('tags.delete_flg',config('const.Tags.Active.Active'));

        $data = $data
        ->Join('users','question_boxes.account_uuid', '=', 'users.account_uuid')
        ->Join('tags', 'question_boxes.question_uuid', '=', 'tags.question_uuid')
        ->get();

        return $data;
    }

    public static function createQuestion($authUuid, $questionBody, $questionTitle)
    {
        $data = new QuestionBox();
        $data->question_uuid = (string) Str::uuid();
        $data->account_uuid = $authUuid;
        $data->title = $questionTitle;
        $data->body = $questionBody;
        $data->view_counter = config('const.QuestionBox.ViewCounter.Default');
        $data->delete_flg = config('const.QuestionBox.Active.Active');
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        return $data;
    }

    public static function viewCount($id)
    {
        $data = QuestionBox::where('question_uuid',$id)
        ->where('delete_flg',config('const.QuestionBox.Active.Active'))
        ->first();

        $data->view_counter++;
        $data->save();
    }
    public static function detail($id)
    {
        $result = self::select(
            'title',
            'body',
            'view_counter',
            'updated_at',
            'users.account_name as user_name',
            'users.login_id',
            'users.logo'
        )
        ->where('question_uuid',$id)
        ->where('question_boxes.delete_flg',config('const.QuestionBox.Active.Active'));

        $result = $result
        ->leftJoin('users','question_boxes.account_uuid', 'users.account_uuid')
        ->where('users.delete_flg',config('const.User.Active.Active'))
        ->first();

        return $result;
    }
}
