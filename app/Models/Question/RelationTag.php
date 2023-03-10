<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationTag extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $table = 'relation_tags';

    public static function create($questionId,$tag)
    {
        foreach ($tag as $tag) {
            $data = new RelationTag();
            $data->question_id = $questionId;
            $data->tag_id = $tag->tag_id;
            $data->created_at = now();
            $data->updated_at = now();
            $data->save();
        }
    }
}
