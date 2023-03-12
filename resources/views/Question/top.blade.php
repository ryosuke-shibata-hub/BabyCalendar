@extends('MainContent.layouts')
@section('title', 'FirstBaby-質問箱-')
@section('content')
@include('common.header')
<div class="container pb-3 text-cente">
    <div class="row">
        <div class="col-sm-3">
            {{-- @include('Question.right_bar') --}}
        </div>
        <div class="mt-3 col-sm-6">
            <form action="/FirstBaby/Question" method="GET">
                <div class="row">
                <div class="text-center col-sm-10">
                    <input type="text" class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" placeholder="検索条件を入力してください" name="search_word">
                </div>
                <div class="text-center col-sm-2">
                    <button type="submit" class="w-full p-2 mt-1 font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg text-md w-50 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
                        検索
                    </button>
                </div>
                </div>
            </form>
            @if(!empty($questionList->count() == 0 ))
                <div class="pt-5 text-center">
                    <div class="font-semibold display-７">
                        <p>
                            「{{ request()->search_word }}」に該当する記事は見つかりませんでした。
                        </p>
                        <p>😢</p>
                    </div>
                </div>
                @elseif(!empty($questionList->count() != 0 ) && (!empty(request()->search_word)))
                <div class="py-3 text-center">
                    <div class="font-semibold display-７">
                        <p>
                            「{{ request()->search_word }}」の検索結果
                        </p>
                    </div>
                </div>
            @endif
            @foreach($questionList as $list)
                <article class="p-2 my-3 border-2 border-pink-100 rounded-md link-zone-parent">
                    <a href="/FirstBaby/Question/{{ $list->question_id }}" tabindex="-1" class="link-zone-child"></a>
                        <header style="display:flex;">
                            <a href="/FirstBaby/{{ $list->login_id }}">
                                @if($list->logo == $defaltLogoImg)
                                    <img class="p-1 rounded-full w-14 h-14"
                                    src="{{ asset($list->logo) }}">
                                @else
                                    <img class="p-1 rounded-full w-14 h-14"
                                    src="{{ Storage::url($list->logo) }}">
                                @endif
                            </a>
                            <div class="mt-2 ml-2">
                                <p class="text-sm font-bold text-gray-700 hover:text-pink-300">
                                    <a href="/FirstBaby/mypage/{{ $list->login_id }}" class="outline-none hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                                        &#64;{{ $list->account_name }}
                                    </a>
                                </p>
                                <span class="text-xs text-left d-block">
                                    {{Carbon\Carbon::parse($list->created_at)->format('Y年m月n日')}}
                                </span>
                            </div>
                        </header>
                        <h2 class="py-2 pl-3 ml-20 -mt-3 text-3xl font-bold text-left text-gray-700">
                            <a href="/FirstBaby/Question/{{ $list->question_id }}" class="hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                                {{ $list->title }}
                            </a>
                        </h2>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="text-xs col-sm-7">
                            {{-- タグネームをカンマ区切りで分割して書くタグを回す --}}
                            @foreach(explode(',',$list->tag_name) as $tag)
                                <a href="{{ $tag }}" class="outline-none hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                                    <i class="fa-solid fa-hashtag"></i>{{ $tag }}
                                </a>
                            @endforeach
                            </div>
                            <div class="text-xs text-right col-sm-2">
                                @if(!Auth::check())
                                    <a href="/FirstBaby/login" class="outline-none hover:text-pink-300">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                @elseif($list->FavoriteFlg === 0)
                                    <a questionId="{{ $list->question_id }}"
                                        favoriteFlg="{{ $list->FavoriteFlg }}"
                                        userId="{{ Auth::user()->account_uuid }}"
                                        type="submit"
                                        class="outline-none questionFavoriteFlg hover:text-pink-300">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                @elseif($list->FavoriteFlg === 1)
                                    <a  questionId="{{ $list->question_id }}"
                                        favoriteFlg="{{ $list->FavoriteFlg }}"
                                        userId="{{ Auth::user()->account_uuid }}"
                                        type="submit"
                                        class="outline-none questionFavoriteFlg hover:text-pink-300">
                                        <i class="text-pink-400 fa-solid fa-heart"></i>
                                    </a>
                                @endif
                                <span id="questionFavoriteCount{{ $list->question_id }}">
                                    {{ $list->FavoriteCount }}
                                </span>
                            </div>
                            <div class="text-xs text-left col-sm-2">
                                <span class="">
                                    閲覧数：{{ $list->view_counter }} view
                                </span>
                            </div>
                        </div>

                </article>
            @endforeach
        </div>
        <div class="col-sm-3">
            @include('Question.right_bar')
        </div>
    </div>
</div>
@endsection
