@extends('guest.layouts')
@section('title', 'FirstBaby')
{{-- @include('common.header') --}}
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
        <div class="text-center col-md-5 column right">
            <div class="py-10"></div>
            <div class="py-10">
                <p class="pb-5 display-6">アカウントをお持ちの方</p>
                <a href="/FirstBaby/login" class="px-4 py-2 font-bold text-white bg-pink-300 border-b-4 border-pink-500 rounded hover:bg-pink-200 hover:border-pink-300">ログイン</a>
            </div>
            <div class="py-10">
                <p class="pb-5 display-6">アカウントをお持ちでない方</p>
                <a href="#" class="px-4 py-2 font-bold text-white bg-green-300 border-b-4 border-green-500 rounded hover:bg-green-200 hover:border-green-300">とうろく</a>
            </div>
            <div class="py-10">
                <p class="pb-5 display-6">ゲストとしてログイン</p>
                <a href="#" class="px-4 py-2 font-bold text-white bg-blue-300 border-b-4 border-blue-500 rounded hover:bg-blue-200 hover:border-blue-300">トップページへ</a>
            </div>
        </div>
    </div>
    <footer>
        <div class="mb-10 text-center">
            <span class="font-bold">&copy; 2023 first-baby.</span>
        </div>
    </footer>
</div>
@endsection
{{-- @include('common.footer') --}}
