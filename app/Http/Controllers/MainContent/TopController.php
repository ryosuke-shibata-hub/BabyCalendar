<?php

namespace App\Http\Controllers\MainContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function top()
    {
        return view('MainContent.top');
    }
}
