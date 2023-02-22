    <!--モーダル-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
            aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p></p>
                    <h5 class="modal-title" id="editModalTitle">
                        アカウント編集
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="" type="hidden" name="account_uuid" value="{{ $userInformation->account_uuid }}">
                    <div class="text-center">
                        <h3>アカウント情報を更新しますか？</h3>
                    </div>
                    <div class="">
                        <h3 class="py-3">アカウント情報を更新するにはパスワードを入力してください</h3>
                        <input type="password" class="w-full px-2 py-2 my-1 mr-3 leading-tight text-gray-700 bg-transparent border-2 border-pink-200 rounded-lg appearance-none formInput focus:outline-none focus:border-pink-500 hover:bg-pink-200 focus:ring-4 focus:ring-pink-300" name="password">
                    </div>
                    <div class="py-2 text-center">
                        <button type="submit" class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700">
                            更新
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
