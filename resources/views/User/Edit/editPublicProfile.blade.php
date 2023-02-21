<div class="">
    <div class="text-center">
        <h2 class="font-bold">-公開用プロフィール-</h2>
    </div>
    <div class="">
        @include('Message.Error.validate')
        @include('Message.Succsess.message')
    </div>
    <form action="/FirstBaby/edit/profile/update" method="POST" enctype="multipart/form-data">
        @csrf
        @include('modals.editConfirm')
        <div class="">
            <div class="items-center py-2 border-b border-pink-300">
                <div class="">
                    <label class="">アカウントネーム</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="text" placeholder="" aria-label="accountName" name="accountName" value="{{ $userInformation->account_name }}">
                    <label class="">自己紹介</label>
                    <textarea style="line-height: 1.5; height:150px;" class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="text"aria-label="myComment" name="myComment">{{ $userInformation->comment }}</textarea>
                    <label class="">プロフィール画像</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="file" aria-label="myLogo" name="myLogo">
                    <label class="">プロフィール背景画像</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="file" placeholder="" aria-label="myBackgroundLogo" name="myBackgroundLogo">
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
