<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    use HasFactory;

    public static function createComment($questionId, $questionComment, $authUuid)
    {
        $deleteFlg = config('const.QuestionBox.Comment.Active.Active');

        $data = new QuestionComment();
        $data->account_uuid = $authUuid;
        $data->question_id = $questionId;
        $data->question_comment = $questionComment;
        $data->delete_flg = $deleteFlg;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();
    }
}
