@extends('MainContent.layouts')
@section('title', 'FirstBaby-新規登録-')
{{-- @include('common.header') --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 column left-register">
            <div class="" style="margin-top: -10%;">
                <h2 class="font-bold text-center text-pink-300 nikukyu-font display-3">
                    しんきとうろく
                </h2>
            </div>
        </div>
        <div class=" col-md-6 column right">
            <div class="py-20"></div>
            <div class="w-full" id="registerForm">
                <div class="items-center py-2">
                    <!--バリーデーションメッセージ-->
                    <table class="table border-pink-300">
                    <tbody class="text-sm">
                        <tr>
                            <td class="align-middle">ログインID</td>
                            <td>
                                <span class="text-pink-300">※サイト内で利用するIDになります。</span>
                                <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="text" placeholder="半角英数字記号(-_)で8文字以上16文字以内で入力してください" aria-label="Full name" name="loginId" value="{{ old('loginId') }}" required>
                                @include('Error.Form.loginId')
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">メールアドレス</td>
                            <td>
                                <span class="text-pink-300">※有効なメールアドレスを入力してください。</span>
                                <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="mail" placeholder="メールアドレス" aria-label="Full name" name="email" value="{{ old('email') }}" required>
                                @include('Error.Form.email')
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">ユーザー名</td>
                            <td>
                                <span class="text-pink-300">※サイト内で利用するユーザー名になります。</span>
                                <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border rounded appearance-none formInput focus:outline-none" type="text" placeholder="最大16文字以内で入力してください" aria-label="Full name" name="accountName" value="{{ old('accountName') }}" required>
                                @include('Error.Form.accountName')
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">パスワード</td>
                            <td>
                                <span class="text-pink-300">※半角英数記号(大文字小文字)をそれぞれ一つ以上含み8文字以上で入力してください</span>
                                <input class="text-gray-700 border rounded form-control focus:outline-none" type="password" placeholder="パスワード" aria-label="Full name" name="password" data-toggle="password" required>
                                @include('Error.Form.password')
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">確認用パスワード</td>
                            <td>
                                <span class="text-pink-300">※半角英数記号(大文字小文字)をそれぞれ一つ以上含み8文字以上で入力してください</span>
                                <input class="text-gray-700 border rounded form-control focus:outline-none" type="password" placeholder="確認用パスワード" aria-label="Full name" name="confirmPassword" data-toggle="password" required>
                                @include('Error.Form.passwordConfirm')
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <div class="text-center">
                        <button class="flex-shrink-0 px-2 py-1 text-white bg-pink-500 border-4 border-pink-500 rounded confirmButton hover:bg-pink-700 hover:border-pink-700 form-btn" type="button" data-bs-toggle="modal" data-bs-target="#registerModal" id="confirmButton">
                        アカウントを作成
                        </button>
                        <a href="/FirstBaby/welcome" class="flex-shrink-0 px-2 py-1 text-pink-500 border-4 border-transparent rounded hover:text-pink-800">
                        キャンセル
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- モーダル画面 -->
    @include('modals.register_confirm')
</div>
@endsection
@include('Common.Guest.footer')
