<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\Question\Tags;
use App\Models\User\User;

use DB;

class QuestionBox extends Model
{
    use HasFactory;
    protected $table = 'question_boxes';
    public $incrementing = false;
    protected $primaryKey = 'question_uuid';

    protected $fillable = [
        'question_uuid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function users()
    // {
    //     return $this->belongsTo(User::class,'account_uuid','account_uuid')
    //     ->select(array(
    //         'account_uuid',
    //         'account_name',
    //         'login_id',
    //         'logo',
    //     ));
    // }
    public function tags()
    {
        return $this->belongsToMany(Tags::class,'relation_tags','question_uuid','tag_uuid')
        ->select(array(
            'tags.tag_name as tag_name',
            'relation_tags.tag_uuid as tag_uuid',
            'relation_tags.question_uuid as question_uuid',
            ));
    }

    public static function indexQuery()
    {
        return self::select('*')
        ->join('users','question_boxes.account_uuid', '=', 'users.account_uuid')
        ->with([
            'tags',
            // 'users',
        ]);

    }

    public static function QuestionList()
    {
        return self::indexQuery()
        ->get();
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
