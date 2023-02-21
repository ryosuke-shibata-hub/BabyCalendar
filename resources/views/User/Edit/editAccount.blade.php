<div class="">
    <div class="text-center">
        <h2 class="font-bold">-公開用プロフィール-</h2>
    </div>
    <div class="">
        @include('Message.Error.validate')
        @include('Message.Succsess.message')
    </div>
    <form action="/FirstBaby/edit/profile/update/account" method="POST" enctype="multipart/form-data">
        @csrf
        @include('modals.editConfirm')
        <div class="">
            <div class="items-center py-2 border-b border-pink-300">
                <div class="">
                    <label class="">ログインID</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-gray-100 border-2 border-pink-200 rounded-lg" type="text" placeholder="{{ $userInformation->login_id }}" value="" disabled>
                    <div class="mt-5 border-t-2"></div>
                    <div class="">
                        <label class="">アカウント削除</label>
                        <br>
                        <span class="text-danger">
                            ※一度アカウントを削除すると元に戻せんません。削除しますか？
                        </span>
                    </div>

                    <button class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700 edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#editModal" id="confirmButton">
                    アカウントを削除する
                    </button>
                    <a href="/FirstBaby/mypage/{{ Auth::user()->login_id }}" class="flex-shrink-0 px-2 py-1 text-sm text-pink-500 border-4 border-transparent rounded hover:text-pink-800">
                    キャンセル
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
