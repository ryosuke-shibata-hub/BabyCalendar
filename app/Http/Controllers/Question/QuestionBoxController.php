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

        // dd($questionList);
        return view('Question.top');
    }
}
