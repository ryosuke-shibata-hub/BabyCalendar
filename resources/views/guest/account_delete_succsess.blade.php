@extends('MainContent.layouts')
@section('title', 'FirstBaby')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 column left">
            <div class="" style="margin-top: -10%;">
                <h2 class="font-bold text-center text-pink-300 nikukyu-font display-3">
                    はじめてのあかちゃん
                </h2>
            </div>
        </div>
        <div class="py-10 text-center col-md-5 column right">
            <div class="py-5"></div>
            <div class="p-3 py-5 border-4 border-pink-100 rounded bg-pink-50">
                <p class="py-5 display-6">FirstBaby</p>
                <p class="py-5 display-6">〜はじめてのあかちゃん〜</p>
                <p class="py-5 display-6">をご利用いただきありがとうございました。</p>
                <a href="/FirstBaby/welcome" class="px-4 py-2 font-bold text-white bg-pink-300 border-b-4 border-pink-500 rounded hover:bg-pink-200 hover:border-pink-300">FirstBabyトップ</a>
            </div>
        </div>
    </div>
</div>
@endsection
@include('Common.Guest.footer')
