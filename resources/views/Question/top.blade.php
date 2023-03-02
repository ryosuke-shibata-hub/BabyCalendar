@extends('MainContent.layouts')
@section('title', 'FirstBaby-質問箱-')
@section('content')
@include('common.header')
<div class="container pb-3 text-cente">
    <div class="row">
        <div class="col-sm-3">
            {{-- @include('Question.right_bar') --}}
        </div>
        <div class="col-sm-6">
            @foreach($questionList as $list)
                <article class="p-2 my-3 border-2 border-pink-100 rounded-md link-zone-parent">
                    <a href="/FirstBaby/question_box/{{ $list->post_uuid }}" tabindex="-1" class="link-zone-child"></a>
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
                                        &#64;{{ $list->user_name }}
                                    </a>
                                </p>
                                <span class="text-xs text-left d-block">
                                    {{ $list->updated_at->format('Y年m月d日') }}
                                </span>
                            </div>
                        </header>
                        <h2 class="pl-3 ml-20 font-bold text-left text-gray-700 display-6">
                            <a href="/FirstBaby/question/{{ $list->post_uuid }}" class="hover:text-pink-300 hover:border-b-2 hover:border-pink-300">
                                {{ $list->title }}
                            </a>
                        </h2>
                </article>
            @endforeach
        </div>
        <div class="col-sm-3">
            @include('Question.right_bar')
        </div>
    </div>
</div>
@endsection
