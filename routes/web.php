<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Guest\TopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::prefix('FirstBaby')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/top', [TopController::class, 'top'])->name('guest_top');//アプリのトップページ
        Route::get('/login', [LoginController::class, 'login'])->name('login');//ログイン画面
        Route::post('/login/process', [LoginController::class, 'loginProcess'])->name('loginProcess');//ログイン処理
        Route::get('/register', [RegisterController::class, 'create'])->name('registerCreate');//新規登録画面
        Route::post('/register/process', [RegisterController::class, 'store'])->name('registerStore');//アカウント登録処理
    });

    Route::middleware('auth')->group(function() {
        Route::get('/test',[TestController::class,'index'])->name('index');
        Route::post('/test/post',[TestController::class,'create'])->name('create');
        Route::post('/test/test', [TestController::class,'test'])->name('create_test');

    });
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     // Route::get('/test',[TestController::class,'index'])->name('index');
//     // Route::post('/test/post',[TestController::class,'create'])->name('create');

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';