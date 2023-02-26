@extends('MainContent.layouts')
@section('title', 'FirstBaby-写真一覧-')
@include('common.header')
@section('content')
<script src="{{ asset('/static/js/upload_image.js') }}" defer></script>
<div class="container text-center w-75">
    <div class="text-center">
        <h2 class="py-3 font-bold">-写真-</h2>
    </div>
    <div class="">
        @include('Message.Error.validate')
        @include('Message.Succsess.message')
    </div>
    <form action="/FirstBaby/edit/image" method="POST">
        @csrf
        <input type="hidden" name="account_uuid" value="{{ $userId }}">
        <div class="mb-3 border-2 border-pink-100 rounded-md">
            <div class="row">
                @foreach($showUserImage as $image)
                    <div class="col-auto">
                        <input class="w-4 h-4 mt-1 text-pink-600 bg-pink-100 border-pink-300 rounded focus:ring-pink-500" type="checkbox" name="check_img[]" value="{{ $image->image }}">
                        <img src="{{ Storage::url($image->image) }}" class="p-1 rounded-lg w-52 h-52">
                    </div>
                @endforeach
            </div>
            <div class="py-3">
                <button type="submit" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-red-500 border-4 border-red-500 rounded hover:bg-red-700 hover:border-red-700 edit-btn" name="delete_image">削除</button>
                <button type="submit" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-green-500 border-4 border-green-500 rounded hover:bg-green-700 hover:border-green-700 edit-btn" name="download_image">ダウンロード</button>
            </div>
        </div>
    </form>
    <div class="p-3 border-2 border-pink-100 rounded-md">
        <form action="/FirstBaby/upload/image" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="">
                <label class="pb-1" for="upload_image">アップロードする画像を選択してください</label>
                <br>
                <span class="pb-3">※複数画像をアップロードする際は、画像をまとめてドラッグ&ドロップするか、ファイル選択時に複数枚選択してください。</span>
                <input id="fileImage" type="file" name="files[][upload_image]" class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" multiple accept="image/*">
                <input type="hidden" name="account_uuid" value="{{ $userId }}">
            </div>
            <div class="row" id="preview"></div>
            <div class="">
                <button type="submit" class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700 edit-btn">アップロード</button>
            </div>
        </form>
    </div>
</div>
@endsection
@include('Common.Guest.footer')
