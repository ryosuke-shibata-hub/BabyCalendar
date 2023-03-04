@extends('MainContent.layouts')
@section('title', 'FirstBaby-質問の詳細-')
@section('content')
@include('common.header')
<div class="container py-2 text-cente">
    <div class="">
        @include('Message.Succsess.message')
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="p-3 my-3 border-2 border-pink-100 rounded-md link-zone-parent">
                <header class="row">
                    <a class="col-sm-1" href="/FirstBaby/mypage/{{ $questionDetail->login_id }}">
                        @if($questionDetail->logo == $defaltLogoImg)
                            <img class="p-1 rounded-full w-14 h-14"
                            src="{{ asset($questionDetail->logo) }}">
                        @else
                            <img class="p-1 rounded-full w-14 h-14"
                            src="{{ Storage::url($questionDetail->logo) }}">
                        @endif
                    </a>
                    <div class="mt-2 col-sm-8">
                        <p class="text-sm font-bold text-gray-700 hover:text-pink-300">
                            <a href="/FirstBaby/mypage/{{ $questionDetail->login_id }}" class="outline-none hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                                &#64;{{ $questionDetail->user_name }}
                            </a>
                        </p>
                        <span class="text-xs text-left d-block">
                            {{ $questionDetail->updated_at->format('Y年m月d日') }}に投稿
                        </span>
                    </div>
                    <div class="text-end col-sm-3">
                        <span class="">
                            閲覧数：{{ $questionDetail->view_counter }} view
                        </span>
                    </div>
                </header>
                <h2 class="ml-16 font-bold text-left text-gray-600 display-6">
                    {{ $questionDetail->title }}
                </h2>
                <div class="py-3 ml-16 text-sm">
                    <a href="#" class="outline-none hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                        <i class="fa-solid fa-hashtag"></i>夜泣き
                    </a>
                </div>
                <section>
                    <div class="ml-16 text-xl">
                        {{ $questionDetail->body }}
                    </div>
                </section>
                <div class="pt-3 text-right">
                    <a class="outline-none hover:text-pink-300">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <span>1</span>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
@endsection
