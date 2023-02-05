@extends('guest.layouts')
@section('title', 'FirstBaby-館員登録が完了しました-')
@section('content')
<div class="container">
    <div class="row">
        <div class="text-center">
            <h2 class="font-bold text-center text-pink-300 nikukyu-font display-3">
                はじめまして！
            </h2>
            @if(session('accountName'))
                <div class="pt-5 text-xl font-bold">
                    <p class="py-2">はじめまして{{ session('accountName') }}さん！</p>
                    <p class="py-5">会員登録が完了いたしました。</p>
                    <p class="py-2">ログインページからログインして「はじめてのあかちゃん」をお楽しみください！</p>
                </div>
                <div class="">
                    <img src="/image/22493487.jpg" class="w-25 h-25 d-inline-block">
                </div>
                <div class="py-10">
                    <a href="/FirstBaby/login" class="flex-shrink-0 px-2 py-1 text-white bg-pink-500 border-4 border-pink-500 rounded confirmButton hover:bg-pink-700 hover:border-pink-700">ログイン画面</a>
                </div>
            @else
                <div class="">
                    <img src="/image/22493487.jpg" class="w-25 h-25 d-inline-block">
                </div>
                <div class="py-10">
                    <a href="/FirstBaby/login" class="flex-shrink-0 px-2 py-1 text-white bg-pink-500 border-4 border-pink-500 rounded confirmButton hover:bg-pink-700 hover:border-pink-700">ログイン画面</a>
                </div>
            @endif
        </div>
    </div>
    @include('Common.Guest.footer')
</div>
@endsection
