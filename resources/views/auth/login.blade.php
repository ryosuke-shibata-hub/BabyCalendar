@extends('MainContent.layouts')
@section('title', 'FirstBaby-ログイン-')
{{-- @include('common.header') --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 column left-login">
            <div class="" style="margin-top: -10%;">
                <h2 class="font-bold text-center text-pink-300 nikukyu-font display-3">
                    ログイン
                </h2>
            </div>
        </div>
        <div class=" col-md-5 column right">
            <div class="py-20"></div>
            @if(session('errmessage'))
                <h4 class="text-danger">
                    {{ session('errmessage') }}
                </h4>
                <div class="divider-form"></div>
            @endif
            <form action="/FirstBaby/login/process" method="POST" class="w-full max-w-sm">
                @csrf
                <div class="flex items-center py-2 border-b border-pink-300">
                    <div class="">
                        <label class="">ログインID</label>
                        <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="text" placeholder="ログインID" aria-label="Full name" name="loginId">
                        <label class="">パスワード</label>
                        <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="password" placeholder="パスワード" aria-label="Full name" name="password">
                        <button class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700" type="submit">
                        ログイン
                        </button>
                        <a href="/FirstBaby/welcome" class="flex-shrink-0 px-2 py-1 text-sm text-pink-500 border-4 border-transparent rounded hover:text-pink-800">
                        キャンセル
                        </a>
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>
@endsection
@include('Common.Guest.footer')
