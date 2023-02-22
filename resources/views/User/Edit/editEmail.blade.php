<div class="">
    <div class="text-center">
        <h2 class="font-bold">-メールアドレスと通知-</h2>
    </div>
    <div class="">
        @include('Message.Error.validate')
        @include('Message.Succsess.message')
    </div>
    <form action="/FirstBaby/edit/profile/update/email" method="POST" enctype="multipart/form-data">
        @csrf
        @include('modals.editConfirm')
        <div class="">
            <div class="items-center py-2 border-b border-pink-300">
                <div class="">
                    <label class="">登録メールアドレス</label>
                    <input class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" type="email" placeholder="" aria-label="email" name="email" value="{{ $userInformation->email }}">
                    <label class="pt-5 pb-2">通知</label>
                    <div class="flex items-center mb-4">
                        <input id="default-radio-1" type="radio" value="0" name="use_notification" class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-500 focus:ring-pink-500 focus:ring-2">
                        <label for="default-radio-1" class="pl-2 pr-3 text-sm font-medium">有効</label>
                        <input checked id="default-radio-2" type="radio" value="1" name="use_notification" class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-500 focus:ring-pink-500 focus:ring-2">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium">無効</label>
                    </div>
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
