@extends('MainContent.layouts')
@section('title', 'FirstBaby-質問の作成-')
@section('content')
@include('common.header')
<div class="container py-2 text-cente">
    <div class="">
        @include('Message.Error.validate')
    </div>
    <form action="/FirstBaby/create/question/store" method="POST">
        @csrf
        <input type="hidden" name="account_uuid" value="{{ $userId }}">
        <input type="text" class="w-full px-2 py-2 my-1 mr-3 bg-gray-50 border border-pink-300 text-gray-700 text-xl rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5 focus:ring-4 ring-lime-800" placeholder="タイトル" name="title">
        <input type="text" class="w-full px-2 py-2 my-1 mr-3 bg-gray-50 border border-pink-300 text-gray-700 text-xl rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5 focus:ring-4 ring-lime-800" placeholder="ハッシュタグを最大5個まで登録できます。ハッシュタグをつける場合は「#」をハッシュタグの先頭に付けてください。例)#離乳食#夜泣き" name="tag[]">
        <textarea class="w-full question-text-zone bg-gray-50 border border-pink-300 text-gray-700 text-xl rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5 focus:ring-4 ring-lime-800" name="detail"></textarea>
        <div class="pt-3 pb-2 row">
            <div class="col-sm-2">
                <a href="/FirstBaby/Question" class="py-3 font-bold text-center text-gray-500 border-2 border-red-400 rounded-lg text-md d-inline-block w-100 hover:text-white hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-500">戻る</a>
            </div>
            <div class="col-sm-8"></div>
            <div class="col-sm-2">
                <button type="submit" class="py-3 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg text-md d-inline-block w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">質問を作成する</button>
            </div>
        </div>
    </form>
</div>
@endsection
