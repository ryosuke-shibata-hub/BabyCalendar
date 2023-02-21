@extends('MainContent.layouts')
@section('title', 'FirstBaby-トップマイページ-')
@include('common.header')
@section('content')
<div class="container text-center w-75">
  <div class="mb-3 border-2 border-pink-100 rounded-md">
    <div class="">
        @if($userInformation->background_logo == $defaltBackgroundImg)
        <img class="h-50 w-100 d-inline-block" src="{{ asset($userInformation->background_logo) }}">
        @else
        <img class="h-50 w-100 d-inline-block"
            src="{{ Storage::url($userInformation->background_logo) }}">
        @endif
    </div>
    <div class="ml-10 -mt-20">
        @if($userInformation->logo == $defaltLogoImg)
            <img class="w-40 h-40 p-1 rounded-full ring-2 ring-gray-200"
            src="{{ asset($userInformation->logo) }}">
        @else
            <img class="w-40 h-40 p-1 rounded-full ring-2 ring-gray-200"
            src="{{ Storage::url($userInformation->logo) }}">
        @endif
    </div>
    <div class="px-16 py-3">
        <div class="row">
            <div class="font-bold text-left">
                <span class="">{{ $userInformation->account_name }}</span>
            </div>
            <div class="text-right">
                <a href="#" class="text-white bg-pink-200 hover:bg-pink-300 focus:outline-none focus:ring-4 focus:ring-pink-300 font-medium rounded-full text-sm px-3 py-2.5 text-center mr-2 mb-2">フォロー</a>
                <a href="#" class="text-white bg-pink-200 hover:bg-pink-300 focus:outline-none focus:ring-4 focus:ring-pink-300 font-medium rounded-full text-sm px-3 py-2.5 text-center mr-2 mb-2">フォロワー</a>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                </a>
            </div>
        </div>
        <div class="">
            <span class="">
                {{ $userInformation->comment }}
            </span>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md">
        <a href="#" type="button" class="py-3 mb-2 mr-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            通知
            <i class="fa-regular fa-bell"></i>
        </a>
    </div>
    <div class="col-md">
        <a href="#" type="button" class="py-3 mb-2 mr-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            写真
            <i class="fa-regular fa-image"></i>
        </a>
    </div>
    <div class="col-md">
        <a href="#" type="button" class="py-3 mb-2 mr-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            ファミリー
            <i class="fa-solid fa-house-chimney-window"></i>
        </a>
    </div>
    <div class="col-md">
        <a href="/FirstBaby/edit/profile" type="button" class="py-3 mb-2 mr-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            プロフィール
            <i class="fa-regular fa-user"></i>
        </a>
    </div>
    <div class="col-md">
        <a href="#" type="button" class="py-3 mb-2 mr-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            友達
            <i class="fa-regular fa-handshake"></i>
        </a>
    </div>
  </div>
</div>
@endsection
@include('Common.Guest.footer')
