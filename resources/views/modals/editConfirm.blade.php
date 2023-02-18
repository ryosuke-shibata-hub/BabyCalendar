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
                    <form action="/FirstBaby/edit/profile/update" method="POST">
                    @csrf
                    <input class="modal-accountName" type="hidden" name="accountName" value="">
                    <input class="modal-myComment" type="hidden" name="myComment" value="">
                    <input class="" type="hidden" name="accountUuid" value="{{ $userInformation->account_uuid }}">
                        <div class="text-center">
                            <h3>アカウント情報を更新しますか？</h3>
                        </div>
                        <div class="py-2 text-center">
                            <button type="submit" class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700">
                                更新
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
