<div class="mt-3 w-75">
    @if(Auth::check())
        <a href="/FirstBaby/create/question" class="py-3 mb-2 mr-2 text-xl font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg d-inline-block w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            質問する<i class="fa-solid fa-pen-to-square"></i>
        </a>
    @else
    <span class="text-xs">
        ※質問するにはログインまたは会員登録が必要です
    </span>
        <a href="/FirstBaby/login" class="py-2 mb-2 mr-2 text-xl font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg d-inline-block w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            ログイン
        </a>
        <a href="/FirstBaby/register" class="py-2 mb-2 mr-2 text-xl font-bold text-center text-gray-500 border-2 border-pink-200 rounded-lg d-inline-block w-100 hover:text-white hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-pink-300">
            会員登録
        </a>
    @endif

</div>
