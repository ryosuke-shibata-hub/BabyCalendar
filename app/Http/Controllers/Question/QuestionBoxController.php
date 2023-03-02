<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question\QuestionBox;

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
        return view('Question.create');
    }
}
