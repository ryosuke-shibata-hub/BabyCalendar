@extends('MainContent.layouts')
@section('title', 'FirstBaby-質問の詳細-')
@section('content')
@include('common.header')
<div class="container py-2 text-cente">
    <div class="">
        @include('Message.Succsess.message')
    </div>
    {{ $questionDetail->title }}
</div>
@endsection
