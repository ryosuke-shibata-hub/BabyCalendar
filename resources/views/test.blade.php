@extends('layouts.app')
@section('title', 'プロフィール設定')
{{-- @include('common.header') --}}
@section('content')
    @if(session('sucsess'))
        {{ session('sucsess') }}
    @endif
    @if($errors)
        <h4 class="col-auto px-5 my-3 font-bold text-center text-danger">
            {{ $errors->first() }}
        </h4>
    @endif
    <div class="container mx-auto">
        <form action="{{ route('create') }}" method="POST">
            <table class="mx-auto rounded-lg table-fixed bg-pink-50 ">
                <thead class="text-left">
                    <tr>
                        <th class="px-5">お名前</th>
                        <th class="px-5">性別</th>
                        <th class="px-5">年齢</th>
                        <th class="px-5">プロフィール画像</th>
                    </tr>
                </thead>
                @for($i = 0 ; $i < 5; $i ++)
                    <input type="hidden" name="num[]">
                    @csrf
                    <tbody>
                        <tr>
                            <td class="px-5">
                                <input class="border-gray-400 rounded w-96" type="text" name="name[]">
                            </td>
                            <td class="px-5">
                                <select name="sex[]"　class="w-24 border-gray-400 rounded">
                                    <option value="" selected>-</option>
                                    <option value="1">男の子</option>
                                    <option value="2">女の子</option>
                                </select>
                            </td>
                            <td class="px-5">
                                <select name="age[]"　class="w-24 border-gray-400 rounded">
                                    <option value="" selected>-</option>
                                    @for($age = 0; $age < 20; $age++)
                                        <option value="{{ $age }}">{{ $age }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td class="px-5">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center h-10 bg-gray-100 border-2 border-gray-400 border-dashed rounded-lg cursor-pointer hover:bg-gray-300">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <input id="dropzone-file" type="file" class="hidden" />
                                </label>
                            </td>
                        </tr>
                    </tbody>
                @endfor
                <input type="button"
                class="px-4 text-center text-green-700 border border-green-700 rounded-lg hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" value="+">
            </table>
            <div class="">
                <button type="submit" class="py-1.5 px-4 font-medium text-white transition-colors bg-green-600 border border-green-700 rounded-lg active:bg-green-800 hover:bg-green-700 disabled:opacity-50">追加</button>
            </div>
        </form>
    </div>

    <div class="container mx-auto">
        <form action="/FirstBaby/test/test" method="POST">
            @csrf
            <input class="border-gray-400 rounded w-96" type="text" name="name[]">
            <input class="border-gray-400 rounded w-96" type="text" name="name[]">
            <button type="submit" value="送信">送信</button>
        </form>
    </div>
@endsection
{{-- @include('common.footer') --}}
