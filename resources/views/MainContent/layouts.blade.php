<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon"  href="{{ asset('/favicon.ico') }}">
        <!-- FontAwesome -->
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/earlyaccess/nikukyu.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
        <!-- jQuery -->
        <script   src="https://code.jquery.com/jquery-3.6.3.js"   integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="   crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
        <!-- オリジナルCSS -->
        <link rel="stylesheet" href="/static/css/app.css">
        <!-- オリジナルscript -->
        <script src="{{ asset('/static/js/register_modal.js') }}" defer></script>
        <script src="{{ asset('/static/js/edit_confirm_modal.js') }}" defer></script>
        <script src="/static/js/register_modal.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="main">
        <div class="footerFixed">
            {{-- <div class="header">
                @yield('header')
            </div> --}}
            <div class="content">
                @yield('content')
            </div>
            {{-- <div class="footer"> --}}
            @include('Common.Guest.footer')
            {{-- </div> --}}
        </div>
    </body>
</html>
