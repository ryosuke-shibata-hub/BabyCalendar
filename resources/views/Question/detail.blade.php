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
            {{-- 投稿詳細 --}}
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
                                &#64;{{ $questionDetail->account_name }}
                            </a>
                        </p>
                        <span class="text-xs text-left d-block">
                            {{Carbon\Carbon::parse($questionDetail->created_at)->format('Y年m月n日')}}に投稿
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
                    {{-- タグネームをカンマ区切りで分割して書くタグを回す --}}
                    @foreach(explode(',',$questionDetail->tag_name) as $tag)
                        <a href="{{ $tag }}" class="outline-none hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                            <i class="fa-solid fa-hashtag"></i>{{ $tag }}
                        </a>
                    @endforeach
                </div>
                <section>
                    <div class="ml-16 text-xl">
                        {{ $questionDetail->body }}
                    </div>
                </section>
                <div class="pt-3 text-right">
                    @if(!Auth::check())
                        <a href="/FirstBaby/login" class="outline-none hover:text-pink-300">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                    @elseif($questionDetail->FavoriteFlg === 0)
                        <a questionId="{{ $questionDetail->question_id }}"
                            favoriteFlg="{{ $questionDetail->FavoriteFlg }}"
                            userId="{{ Auth::user()->account_uuid }}"
                            type="submit"
                            class="outline-none questionFavoriteFlg hover:text-pink-300">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                    @elseif($questionDetail->FavoriteFlg === 1)
                        <a  questionId="{{ $questionDetail->question_id }}"
                            favoriteFlg="{{ $questionDetail->FavoriteFlg }}"
                            userId="{{ Auth::user()->account_uuid }}"
                            type="submit"
                            class="outline-none questionFavoriteFlg hover:text-pink-300">
                            <i class="text-pink-400 fa-solid fa-heart"></i>
                        </a>
                    @endif
                    <span id="questionFavoriteCount{{ $questionDetail->question_id }}">
                        {{ $questionDetail->FavoriteCount }}
                    </span>
                </div>
            </div>
            {{-- コメント入力欄 --}}
            <div class="p-2 border-2 border-pink-100 rounded-md link-zone-parent">
                @if(Auth::check())
                    <form action="/FirstBaby/create/comment" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $questionDetail->question_id }}" name="question_id">
                        <input type="hidden" value="{{ Auth::user()->account_uuid }}" name="account_uuid">
                        <textarea style="height:40px;" class="w-full px-2 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="text" placeholder="コメントを入力する..." name="comment"></textarea>
                        <div class="text-end">
                            <button class="flex-shrink-0 px-2 text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700" type="submit">
                                <i class="fa-regular fa-comment-dots">コメントする</i>
                            </button>
                        </div>
                    </form>
                @else
                <div class="text-center">
                    <span class="w-full px-2 text-center">
                        コメントを入力するには
                        <a href="/FirstBaby/login" class="-mx-1 hover:text-pink-300">
                            ログイン
                        </a>
                        してください...
                    </span>
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
@endsection
