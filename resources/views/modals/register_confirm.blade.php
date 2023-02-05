    <!--モーダル-->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog"
            aria-labelledby="registerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p></p>
                    <h5 class="modal-title" id="registerModalTitle">
                        登録内容の確認
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/FirstBaby/register/process" method="POST">
                    @csrf
                        <div class="py-4 border-b-2 form-group row">
                            <div class="col-sm-8">
                                <p class="d-inline-block">ログインID：</p>
                                <p class="modal-login-id d-inline-block"></p>
                                <input class="modal-login-id" type="hidden" name="loginId" value="">
                            </div>
                        </div>
                        <div class="py-4 border-b-2 form-group row">
                            <div class="col-sm-8">
                                <p class="d-inline-block">メールアドレス：</p>
                                <p class="modal-email d-inline-block"></p>
                                <input class="modal-email" type="hidden" name="email" value="">
                            </div>
                        </div>
                        <div class="py-4 border-b-2 form-group row">
                            <div class="col-sm-8">
                                <p class="d-inline-block">アカウント名：</p>
                                <p class="modal-accountName d-inline-block"></p>
                                <input class="modal-accountName" type="hidden" name="accountName" value="">
                            </div>
                        </div>
                        <div class="py-4 border-b-2 form-group row">
                            <div class="col-sm-12">
                                <p class="">パスワード：※セキュリティ保護のため非表示にしています</p>
                            </div>
                            <input class="modal-password" type="hidden" name="password" value="">
                            <input class="modal-password-confirm" type="hidden" name="passwordConfirm" value="">
                        </div>
                        <div class="py-2 text-center">
                            <button type="submit" class="flex-shrink-0 px-2 py-1 mt-5 text-sm text-white bg-pink-500 border-4 border-pink-500 rounded hover:bg-pink-700 hover:border-pink-700">
                                アカウント作成
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
