@extends('guest.layouts')
@section('title', 'FirstBaby-新規登録-')
{{-- @include('common.header') --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 column left-register">
            <div class="" style="margin-top: -10%;">
                <h2 class="font-bold text-center text-pink-300 nikukyu-font display-3">
                    しんきとうろく
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
            {{-- <form action="/FirstBaby/register/process" method="POST" class="w-full max-w-sm">
            @csrf --}}
            <div class="w-full max-w-sm" id="registerForm">
                <div class="flex items-center py-2 border-b border-pink-300">
                    <div class="">
                        <label class="">ログインID</label>
                        <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="text" placeholder="ログインID" aria-label="Full name" name="loginId" required>
                        <label class="">メールアドレス</label>
                        <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="mail" placeholder="メールアドレス" aria-label="Full name" name="email" required>
                        <label class="">アカウント名</label>
                        <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="text" placeholder="アカウント名" aria-label="Full name" name="accountName" required>
                        <label class="">パスワード</label>
                        <input class="text-gray-700 border rounded form-control focus:outline-none" type="password" placeholder="パスワード" aria-label="Full name" name="password" data-toggle="password" required>
                        <label class="">確認用パスワード</label>
                        <input class="text-gray-700 border rounded form-control focus:outline-none" type="password" placeholder="確認用パスワード" aria-label="Full name" name="confirmPassword" data-toggle="password" required>
                        <button class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded confirmButton hover:bg-pink-700 hover:border-pink-700 form-btn" type="button" data-bs-toggle="modal" data-bs-target="#registerModal" id="confirmButton">
                        アカウントを作成
                        </button>
                        <a href="/FirstBaby/top" class="flex-shrink-0 px-2 py-1 text-sm text-pink-500 border-4 border-transparent rounded hover:text-pink-800">
                        キャンセル
                        </a>
                    </div>
                </div>
            {{-- </form> --}}
            </div>
        </div>
    </div>
    <!-- モーダル画面 -->
    @include('modals.register_confirm')
    <footer>
        <div class="mb-10 text-center">
            <span class="font-bold">&copy; 2023 first-baby.</span>
        </div>
    </footer>
</div>
@endsection
{{-- @include('common.footer') --}}
