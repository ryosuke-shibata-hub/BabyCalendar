<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('account_uuid')->comment('UUID');;
            $table->string('account_name')->comment('アカウント名');
            $table->string('login_id')->comment('ログインID');
            $table->binary('background_logo')->nullable()->comment('バックグラウンド画像');
            $table->binary('logo')->nullable()->comment('プロフィール画像');
            $table->string('email')->unique()->comment('登録メールアドレス');
            $table->text('comment')->nullable()->comment('ひとことコメント');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('パスワード');
            $table->integer('delete_flg')->unsigned()->comment('削除フラグ');
            $table->integer('user_roll')->unsigned()->comment('アカウントロール');
            $table->rememberToken();
            $table->timestamp('deleted_at')->comment('アカウント削除日時');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};