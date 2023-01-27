<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        @if(session('sucsess'))
            {{ session('sucsess') }}
        @endif
        @if($errors)
                    <h4 class="col-auto px-5 my-3 font-bold text-center text-danger">
                        {{ $errors->first() }}
                    </h4>
                @endif
        <h1>hello</h1>
        <form action="{{ route('create') }}" method="POST">
            @for($i = 0 ; $i < 2; $i ++)
            <input type="hidden" name="num[]">
            @csrf
            <div class="row">
                <label>名前</label>
                <input class="col" type="text" name="name[]">
            </div>
            <div class="row">
                <label>性別</label>
                <input class="col" type="text" name="sex[]">
            </div>
            <div class="row">
                <label>年齢</label>
                <input class="col" type="text" name="age[]">
            </div>

            @endfor
            <button type="submit">送信</button>
        </form>
{{--
                <form action="{{ route('create') }}" method="post">
        {{ csrf_field() }}
        @for($i = 0 ; $i < 3; $i ++)
        <tr>
            <td><input type="text" name="title[]"></td>
            <td><input type="text" name="author[]"></td>
            <td><input type="text" name="publisher[]"></td>
            <td><input type="text" name="isbn[]"></td>
            <td><input type="text" name="price[]"></td>
            <td><input type="file" name="photo_path[]"></td>
            <td>
                <select name="status[]">
                    <option value="1">新品同様</option>
                    <option value="2">古本</option>
                    <option value="3">汚い</option>
                    <option></option>
                </select>
            </td>
            <td>
                <select name="category_id[]">
                    <option value="1">小説</option>
                    <option value="2">ノンフィクション</option>
                    <option value="3">ビジネス</option>
                    <option value="4">漫画</option>
                    <option value="5">その他</option>
                </select>
            </td>
        </tr>
        <input type="hidden" name="num[]">
        @endfor
        <tr><td><input type="submit" value="登録"></td></tr>
        </form> --}}
    </div>
</body>
</html>
