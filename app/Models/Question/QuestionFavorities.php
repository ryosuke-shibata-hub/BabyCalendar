<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Log;

class QuestionFavorities extends Model
{
    use HasFactory;

    protected $table = 'question_favorities';

    public static function QuestionCreateFavorities($questionId, $userId, $favoriteFlg)
    {
        $LikeItFavorite = config('const.QuestionBox.Favorite.LikeItFavorite');
        $NotLikeFavorite = config('const.QuestionBox.Favorite.NotLikeFavorite');

        if ($favoriteFlg == $LikeItFavorite) {
            $data = new QuestionFavorities();
            $data->account_uuid = $userId;
            $data->question_id = $questionId;
            $data->created_at = now();
            $data->updated_at = now();
            $data->save();
        } elseif($favoriteFlg == $NotLikeFavorite) {
            DB::table('question_favorities')
            ->select(
                'question_id',
                'account_id',
            )
            ->where('question_id',$questionId)
            ->where('account_uuid',$userId)
            ->delete();
        } else {
            Log::alert("質問のいいねで不正リクエスト",['リクエストされたフラグ',$favoriteFlg]);
        }
    }
}
