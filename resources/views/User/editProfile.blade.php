@extends('MainContent.layouts')
@section('title', 'FirstBaby-プロフィール編集-')
@include('common.header')
@section('content')
<div class="container w-75">
    <div class="py-5 row">
        <div class="text-center col-md-3">
            <div class="py-1 font-bold">
                <a href="/FirstBaby/edit/profile" type="button" class="py-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
                    公開用プロフィール
                </a>
            </div>
            <div class="py-1 font-bold">
                <a href="/FirstBaby/edit/account" type="button" class="py-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
                    アカウント設定
                </a>
            </div>
            <div class="py-3 font-bold">メールアドレスと通知</div>
            <div class="py-3 font-bold">パスワード</div>
        </div>
        <div class="col-md-9">
            @if(Request::routeIs('editProfile'))
                @include('User.Edit.editPublicProfile')
            @elseif(Request::routeIs('editAccount'))
                @include('User.Edit.editAccount')
            @endif
        </div>
    </div>
</div>
@endsection
@include('Common.Guest.footer')
