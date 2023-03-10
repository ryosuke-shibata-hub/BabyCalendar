<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\Question\QuestionBox;

use DB;
class Tags extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'tag_id';
    protected $fillable = [
        'tag_name',
    ];

    public function __construct()
    {
        $randmo_int = config('const.RandomNumber.Random_INIT.Rand');
        $digit = config('const.RandomNumber.Random_INIT.Digit');
        $zero = config('const.RandomNumber.Random_INIT.Zero');
    }

    public static function create($tag)
    {
        $commonDeleteFlg = config('const.COMMON.DELETE_FLG');
        $min_init = config('const.RandomNumber.Random_INIT.Min');
        $max_init = config('const.RandomNumber.Random_INIT.Max');
        $digit = config('const.RandomNumber.Random_INIT.Digit');
        $zero = config('const.RandomNumber.Random_INIT.Zero');

        $data = DB::table('tags')
        ->where('tag_name',$tag)
        ->where('delete_flg', $commonDeleteFlg)
        ->get();

        //新規の時は作成してから取得する(tag_idが文字列で取得されるため)
        if ($data->isEmpty()) {
            $data = new Tags();
            $data->tag_name = $tag;
            $data->tag_id = str_pad(random_int($min_init,$max_init),$digit,$zero, STR_PAD_LEFT);
            $data->save();

            $data = DB::table('tags')
            ->where('tag_name',$tag)
            ->where('delete_flg', $commonDeleteFlg)
            ->get();
        }

        return $data;
    }
}
