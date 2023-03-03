<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Question\QuestionBox;

use DB;
use Log;
class QuestionBoxController extends Controller
{
    public function top()
    {
        $questionList = QuestionBox::QuestionList();
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
            // 'tag' => ['bail','image','max:5000'],
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

        if ($accountUuid !== $authUuid) {
            Log::error("アカウント更新で不正なリクエスト",['認証UUID',$authUuid,'リクエストUUID',$accountUuid]);
            return redirect(404);
        }
        try {
            DB::beginTransaction();

            if (!empty($request->tag)) {

            }

            $newQuestion = QuestionBox::createQuestion($authUuid, $questionBody, $questionTitle);

            DB::commit();

            $newMyQuestoiin = $newQuestion->post_uuid;

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
        return view('Question.detail')
        ->with('questionDetail', $questionDetail);
    }
}
