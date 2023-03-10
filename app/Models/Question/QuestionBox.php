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
    protected $primaryKey = 'question_id';

    protected $fillable = [
        'question_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct()
    {
        $random_init = config('const.RandomNumber.Random_INIT.Rand');
        $digit = config('const.RandomNumber.Random_INIT.Digit');
        $zero = config('const.RandomNumber.Random_INIT.Zero');
    }

    public static function QuestionList($request)
    {
        $commonDeleteFlg = config('const.COMMON.DELETE_FLG');

        $question = DB::table('question_boxes')
        ->where('question_boxes.delete_flg',$commonDeleteFlg)
        ->leftJoin('users','question_boxes.account_uuid','=', 'users.account_uuid')
        ->leftJoin('relation_tags','question_boxes.question_id','=','relation_tags.question_id')
        ->leftJoin('tags','relation_tags.tag_id','=','tags.tag_id')
        ->where('tags.delete_flg',$commonDeleteFlg)
        ->select(
            'users.login_id as login_id',
            'users.logo as logo',
            'users.account_name as account_name',
            'question_boxes.question_id as question_id',
            'question_boxes.title as title',
            'question_boxes.updated_at as updated_at',
            'question_boxes.created_at as created_at',
            'question_boxes.view_counter as view_counter',
            //グループ化してタグをまとめる
            DB::raw('GROUP_CONCAT(tags.tag_name) as tag_name'),
        )
        //質問をグループ化して重複を防ぐ
        ->groupBy('question_boxes.question_id');

        //検索条件があった場合
        $searchWord = $request->search_word;
        if ($searchWord) {
            $question = $question
            ->where('title','like','%'.$searchWord.'%')
            ->orwhere('body','like','%'.$searchWord.'%')
            ->orwhere('account_name','like','%'.$searchWord.'%');
        }
        $question->orderBy('question_boxes.created_at','desc');

        return $question->get();
    }

    public static function createQuestion($authUuid, $questionBody, $questionTitle)
    {

        $min_init = config('const.RandomNumber.Random_INIT.Min');
        $max_init = config('const.RandomNumber.Random_INIT.Max');
        $digit = config('const.RandomNumber.Random_INIT.Digit');
        $zero = config('const.RandomNumber.Random_INIT.Zero');

        $data = new QuestionBox();
        $data->question_id = str_pad(random_int($min_init,$max_init),$digit,$zero, STR_PAD_LEFT);
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
        $data = QuestionBox::where('question_id',$id)
        ->where('delete_flg',config('const.QuestionBox.Active.Active'))
        ->first();

        $data->view_counter++;
        $data->save();
    }
    public static function detail($id)
    {
        $commonDeleteFlg = config('const.COMMON.DELETE_FLG');

        $question = DB::table('question_boxes')
        ->where('question_boxes.delete_flg',$commonDeleteFlg)
        ->where('question_boxes.question_id',$id)
        ->leftJoin('users','question_boxes.account_uuid','=', 'users.account_uuid')
        ->leftJoin('relation_tags','question_boxes.question_id','=','relation_tags.question_id')
        ->leftJoin('tags','relation_tags.tag_id','=','tags.tag_id')
        ->where('tags.delete_flg',$commonDeleteFlg)
        ->select(
            'users.login_id as login_id',
            'users.logo as logo',
            'users.account_name as account_name',
            'question_boxes.question_id as question_id',
            'question_boxes.title as title',
            'question_boxes.body as body',
            'question_boxes.updated_at as updated_at',
            'question_boxes.created_at as created_at',
            'question_boxes.view_counter as view_counter',
            //グループ化してタグをまとめる
            DB::raw('GROUP_CONCAT(tags.tag_name) as tag_name'),
        )
        //質問をグループ化して重複を防ぐ
        ->groupBy('question_boxes.question_id');

        return $question->first();
    }
}
