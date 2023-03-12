<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Guest\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MainContent\TopController;
use App\Http\Controllers\User\MyPageController;
use App\Http\Controllers\User\ShowImageController;
use App\Http\Controllers\Question\QuestionBoxController;
use App\Http\Controllers\Question\QuestionCommentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect('FirstBaby/welcome');
});

Route::prefix('FirstBaby')->group(function () {
    //パブリックなルート
    Route::get('/top', [TopController::class, 'top'])->name('top');//アプリのトップページ
    Route::get('/delete/account/confirm', [TopController::class, 'accountDeleteSuccsess'])->name('accountDeleteSuccsess');//アカウント削除成功時の画面
    Route::get('/Question/{id}', [QuestionBoxController::class, 'detail'])->name('question_detail');//質問の詳細画面
    Route::get('/Question/search/{id}', [QuestionBoxController::class, 'search'])->name('question_search');//質問の検索
    Route::get('/Question', [QuestionBoxController::class, 'top'])->name('question_top');//質問箱のトップ
    //ゲストのみ閲覧可能なルート
    Route::middleware('guest')->group(function () {
        Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcome');//アプリのウェルカムページ
        Route::get('/login', [LoginController::class, 'login'])->name('login');//ログイン画面
        Route::post('/login/process', [LoginController::class, 'loginProcess'])->name('loginProcess');//ログイン処理
        Route::get('/register', [RegisterController::class, 'create'])->name('registerCreate');//新規登録画面
        Route::post('/register/process', [RegisterController::class, 'store'])->name('registerStore');//アカウント登録処理
        Route::get('/register/confirm', [RegisterController::class, 'confirm'])->name('registerConfirm');//登録完了画面
    });
    //認証済みユーザーのみ閲覧可能なルート
    Route::middleware('auth')->group(function() {
        Route::post('/logout',[LoginController::class, 'logout'])->name('logout');//ログアウト処理
        Route::get('/mypage/{id}',[MyPageController::class, 'showMypage'])->name('showMypage');//マイページトップ
        Route::get('/edit/profile',[MyPageController::class, 'editProfile'])->name('editProfile');//プ ロフィール編集
        Route::post('/edit/profile/update',[MyPageController::class, 'updateProfile'])->name('updateProfile');//プロフィール編集処理
        Route::get('/edit/account',[MyPageController::class, 'editProfile'])->name('editAccount');//アカウント編集
        Route::post('/edit/profile/update/account',[MyPageController::class, 'updateAccount'])->name('updateAccount');//登録Eメールの編集
        Route::get('/edit/email',[MyPageController::class, 'editProfile'])->name('editEmail');//アカウント編集
        Route::post('/edit/profile/update/email',[MyPageController::class, 'updateEmail'])->name('updateEmail');//登録Eメールの編集処理
        Route::get('/edit/password',[MyPageController::class, 'editProfile'])->name('editPassword');//パスワード編集
        Route::post('/edit/profile/update/password',[MyPageController::class, 'updatePassword'])->name('updatePassword');//パスワードの編集処理
        Route::get('/show/image', [ShowImageController::class, 'showImages'])->name('showImages');//写真の一覧
        Route::post('/upload/image', [ShowImageController::class, 'uploadImages'])->name('uploadImages');//写真のアップロード
        Route::post('/edit/image', [ShowImageController::class, 'editImages'])->name('editImages');//写真の削除、ダウンロード
        Route::get('/create/question', [QuestionBoxController::class, 'create'])->name('question_create');//質問の作成画面
        Route::post('/create/question/store', [QuestionBoxController::class, 'store'])->name('question_store');//質問の作成処理
        Route::post('/Question/favorite', [QuestionBoxController::class, 'QuestionFavorities'])->name('QuestionFavorities');//質問へのいいね機能
        Route::post('/create/comment', [QuestionCommentController::class,'createQuestionComment'])->name('createQuestionComment');//質問へのコメント作成
        Route::get('/test',[TestController::class,'index'])->name('index');
        Route::post('/test/post',[TestController::class,'create'])->name('create');
        Route::post('/test/test', [TestController::class,'test'])->name('create_test');

    });
});

require __DIR__.'/auth.php';
