<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Guest\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MainContent\TopController;
use App\Http\Controllers\User\MyPageController;
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
    Route::get('/top', [TopController::class, 'top'])->name('top');//アプリのトップページ
    Route::middleware('guest')->group(function () {
        Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcome');//アプリのウェルカムページ
        Route::get('/login', [LoginController::class, 'login'])->name('login');//ログイン画面
        Route::post('/login/process', [LoginController::class, 'loginProcess'])->name('loginProcess');//ログイン処理
        Route::get('/register', [RegisterController::class, 'create'])->name('registerCreate');//新規登録画面
        Route::post('/register/process', [RegisterController::class, 'store'])->name('registerStore');//アカウント登録処理
        Route::get('/register/confirm', [RegisterController::class, 'confirm'])->name('registerConfirm');//登録完了画面
    });

    Route::middleware('auth')->group(function() {
        Route::post('/logout',[LoginController::class, 'logout'])->name('logout');//ログアウト処理
        Route::get('/mypage/{id}',[MyPageController::class, 'showMypage'])->name('showMypage');//マイページトップ
        Route::get('/test',[TestController::class,'index'])->name('index');
        Route::post('/test/post',[TestController::class,'create'])->name('create');
        Route::post('/test/test', [TestController::class,'test'])->name('create_test');

    });
});

require __DIR__.'/auth.php';
