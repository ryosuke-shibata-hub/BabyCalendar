@extends('MainContent.layouts')
@section('title', 'FirstBaby-質問の作成-')
@section('content')
@include('common.header')
<div class="container pb-3 mt-3 text-cente">
    <form action="/FirstBaby/question/store" method="POST">
        @csrf
        <input type="text" class="w-full px-2 py-2 my-1 mr-3 bg-gray-50 border border-pink-300 text-gray-700 text-xl rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5 focus:ring-4 ring-lime-800" placeholder="タイトル">
        <input type="text" class="w-full px-2 py-2 my-1 mr-3 bg-gray-50 border border-pink-300 text-gray-700 text-xl rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5 focus:ring-4 ring-lime-800" placeholder="ハッシュタグを最大5個まで登録できます。ハッシュタグをつける場合は「#」をハッシュタグの先頭に付けてください。例)#離乳食#夜泣き">
        <textarea class="w-full"></textarea>
    </form>
</div>
@endsection
