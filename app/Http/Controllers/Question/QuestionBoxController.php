<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Question\QuestionBox;
use App\Models\Question\Tags;
use App\Models\Question\RelationTag;
use App\Models\Question\QuestionFavorities;

use DB;
use Log;
class QuestionBoxController extends Controller
{
    public function top(Request $request)
    {
        $questionList = QuestionBox::QuestionList($request);
        $defaltLogoImg = "/image/defaultLogo.jpg";

        return view('Question.top')
        ->with('questionList', $questionList)
        ->with('defaltLogoImg', $defaltLogoImg);
    }

    public function create()
    {
        $userId = Auth::user()->account_uuid;

        return view('Question.create')
        ->with('userId', $userId);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_uuid' => ['bail','required','string'],
            'title' => ['bail','required','string','max:30',],
            'tag' => ['bail','max:100'],
            'detail' => ['bail','required','string','max:5000'],
        ]);
        if ($validator->fails()) {
            return redirect('/FirstBaby/create/question')
            ->withErrors($validator)
            ->withInput();
        }
        $accountUuid = $request->account_uuid;
        $authUuid = Auth::user()->account_uuid;
        $questionTitle = $request->title;
        $questionBody = $request->detail;

        if ($accountUuid != $authUuid) {
            Log::error("質問の投稿で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
            return redirect(404);
        }
        try {
            DB::beginTransaction();

            $newQuestion = QuestionBox::createQuestion($authUuid, $questionBody, $questionTitle);

            if (!empty($request->tag)) {
                //#タグのついた文字列を取得
                preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag, $match);
                $tags = [];
                //$matchの中でも#が付いていない方を使用する(配列番号で言うと1)
                //tagテーブルにリクエストできたタグがなければ作成あればスキップ
                foreach ($match[1] as $tag) {
                    $data = Tags::create($tag);
                    array_push($tags, $data);
                };
                foreach ($tags as $tag) {
                    $questionId = $newQuestion->question_id;
                    RelationTag::create($questionId,$tag);
                };
            }
            DB::commit();
            $newMyQuestoiin = $newQuestion->question_uuid;
            return redirect('FirstBaby/Question/'.$newMyQuestoiin)
            ->with('succsess_msg',"質問を投稿しました");
        } catch (\Throwable $th) {
            Log::error("質問の作成で例外処理発生",['アカウントUUID',$authUuid,$th]);
            return redirect('/FirstBaby/create/question')
            ->with('err_message','質問の作成に失敗しました。操作を再度お試しください');
        }
    }

    public function detail($id)
    {
        $questionDetail = QuestionBox::detail($id);
        $viewCount = QuestionBox::viewCount($id);
        $defaltLogoImg = "/image/defaultLogo.jpg";
        Log::info('質問詳細の記事',['記事',$questionDetail]);

        return view('Question.detail')
        ->with('questionDetail', $questionDetail)
         ->with('defaltLogoImg', $defaltLogoImg);
    }

    public function QuestionFavorities(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'question_id' => ['required','string'],
            'user_id' => ['required','string'],
            'favorite_flg' => ['required','string'],
        ]);
        //バリデーションに引っかかるものは全て不正リクエストのため不正扱い
        if ($validator->fails()) {
            Log::alert("質問のいいねでバリデーション不正",[$validator->fails()]);
            return redirect(404);
        }

        try {

            DB::beginTransaction();

            $favoriteFlg = $request->favorite_flg;
            $questionId = $request->question_id;
            $userId = $request->user_id;

            $favoriteStatus = QuestionFavorities::QuestionCreateFavorities($questionId, $userId, $favoriteFlg);

            DB::commit();

            return redirect('/FirstBaby/Question');

        } catch (\Throwable $th) {
            Log::error("質問のいいね処理で例外処理発生",['アカウントUUID',$userId,'質問のID',$questionId,$th]);
            return redirect('/FirstBaby/Question')
            ->with('err_message','質問のいいね処理に失敗しました。操作を再度お試しください');
        }

    }
}
