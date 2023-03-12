<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Question\QuestionComment;

use Log;

class QuestionCommentController extends Controller
{
    public function createQuestionComment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'question_id' => ['required','string'],
            'account_uuid' => ['required','string'],
            'comment' => ['required','string','max:2500'],
        ]);
        if ($validator->fails()) {
            Log::error("コメントでバリデーションエラー",[$validator->fails()]);
            return redirect('/FirstBaby/Question/' . $request->question_id)
            ->withErrors($validator)
            ->withInput();
        }

        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;
        $questionId = $request->question_id;
        $questionComment = $request->comment;

        if ($accountUuid != $authUuid) {
            Log::error("コメントの投稿で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
            return redirect(404);
        }
        try {

            QuestionComment::createComment($questionId, $questionComment, $authUuid);

            Log::info("コメントの投稿",['投稿者',$authUuid,'コメント内容',$questionComment]);
            return redirect('/FirstBaby/Question/' . $request->question_id)
            ->with('succsess_msg','コメントを投稿しました');

        } catch (\Throwable $th) {
            Log::error("コメントの作成で例外処理発生",['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/Question/' . $request->question_id)
            ->with('err_message','コメントの作成に失敗しました。操作を再度お試しください');
        }
        dd($request);
    }
}
