<div class="">
    <div class="text-center">
        <h2 class="font-bold">-パスワード変更-</h2>
    </div>
    <div class="">
        @include('Message.Error.validate')
        @include('Message.Succsess.message')
    </div>
    <form action="/FirstBaby/edit/profile/update/password" method="POST" enctype="multipart/form-data">
        @csrf
        @include('modals.editConfirm')
        <div class="">
            <div class="items-center py-2 border-b border-pink-300">
                <div class="">
                    <label class="">新しいパスワード</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="password" name="newPassword" value="" data-toggle="password">
                    <div class="py-3"></div>
                    <label class="">新しいパスワード（確認用）</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="password" name="passwordConfirm" value="" data-toggle="password">
                    <div class="py-3"></div>
                    <button class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700 edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#editModal" id="confirmButton">
                    更新
                    </button>
                    <a href="/FirstBaby/mypage/{{ Auth::user()->login_id }}" class="flex-shrink-0 px-2 py-1 text-sm text-pink-500 border-4 border-transparent rounded hover:text-pink-800">
                    キャンセル
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
