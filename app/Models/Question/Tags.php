<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question\QuestionBox;

class Tags extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'tag_uuid';

    // public function QuestionBox()
    // {
    //     return $this->belongsToMany(QuestionBox::class,'relation_tags','question_uuid','tag_uuid')
    //     ->withTimestamps();
    // }

    // public static function TagList() {
    //     $tag_list = DB::table('tags')
    //     ->get();

    //     return $tag_list;
    // }

}
