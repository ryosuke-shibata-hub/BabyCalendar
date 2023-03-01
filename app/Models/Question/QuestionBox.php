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
            'body',
            'view_counter',
            'updated_at',
        )
        ->where('delete_flg', config('const.QuestionBox.Active.Active'))
        ->get();

        return $data;
    }
}
