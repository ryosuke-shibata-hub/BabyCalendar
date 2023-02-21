<div class="bg-pink-100">
    <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <a class="d-inline-block" href="/FirstBaby/top">
                    <img src="{{ asset('/image/icon.png') }}" class="">
                </a>
            </div>
            <div class="my-auto font-bold text-center col-sm-1">
                <a href="/FirstBaby/mypage/{{ Auth::user()->login_id }}" class="py-2 text-xs text-center border border-white rounded-lg d-block hover:text-pink-200 hover:bg-white">
                    マイページ
                </a>
            </div>
            {{-- <div class="py-2 my-auto mr-1 text-xs text-center border border-white rounded-lg col-sm-1 hover:text-pink-200 hover:bg-white hover:border-gray-500">マイカレンダー</div> --}}
            {{-- <div class="py-2 my-auto text-xs text-center border border-white rounded-lg col-sm-1 hover:text-pink-200 hover:bg-white hover:border-gray-500">タイムライン</div> --}}
            <div class="py-2 my-auto mr-1 text-xs font-bold text-center border border-white rounded-lg col-sm-1 hover:text-pink-200 hover:bg-white hover:border-gray-500">質問箱</div>
            <div class="py-2 my-auto mr-1 text-xs font-bold text-center border border-white rounded-lg col-sm-1 hover:text-pink-200 hover:bg-white hover:border-gray-500">日記</div>
            <div class="my-auto mr-1 text-center col-sm-4">
                <div class="py-2 my-auto font-bold text-white border-2 border-white rounded-lg">
                    FirstBaby〜はじめてのあかちゃん〜
                </div>
            </div>
            <div class="py-2 my-auto mr-1 text-xs font-bold text-center border border-white rounded-lg col-sm-1 hover:text-pink-200 hover:bg-white hover:border-gray-500">SHOP</div>
            <div class="py-2 my-auto mr-1 text-xs font-bold text-center border border-white rounded-lg col-sm-1 hover:text-pink-200 hover:bg-white hover:border-gray-500">お問合せ</div>
            <div class="my-auto font-bold text-center col-sm-1">
                @if(Auth::check())
                    <form action="/FirstBaby/logout" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 mt-3 -ml-3 text-xs text-center border border-white rounded-lg hover:text-white hover:bg-red-500 d-block">
                        ログアウト
                    </button>
                    </form>
                @elseif(!Auth::check())
                    <a href="/FirstBaby/login" class="py-2 text-xs text-center border border-white rounded-lg d-block hover:text-white hover:bg-green-500">
                        ログイン
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
