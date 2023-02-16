@extends('MainContent.layouts')
@section('title', 'FirstBaby-トップマイページ-')
@include('common.header')
@section('content')
<div class="container text-center w-75">
  <div class="mb-3 border-2 border-pink-100 rounded-md">
    <div class="">
        <img class="w-36 d-inline-block" src="{{ asset($userInformation->background_logo) }}">
    </div>
    <div class="ml-10 -mt-10">
        <img class="w-20 h-20 p-1 rounded-full ring-2 ring-gray-200" src="{{ asset($userInformation->logo) }}">
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
  <div class="pl-2 row">
    <div class="col-sm-3">
        <a href="#" type="button" class="px-24 py-3 mb-2 mr-2 text-xl font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            通知
            <i class="fa-regular fa-bell"></i>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="#" type="button" class="px-24 py-3 mb-2 mr-2 text-xl font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            写真
            <i class="fa-regular fa-image"></i>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="#" type="button" class="px-24 py-3 mb-2 mr-2 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            ファミリー
            <i class="fa-solid fa-house-chimney-window"></i>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="#" type="button" class="px-24 py-3 mb-2 mr-2 text-xl font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            友達
            <i class="fa-solid fa-user-group"></i>
        </a>
    </div>
  </div>
</div>
@endsection
@include('Common.Guest.footer')
