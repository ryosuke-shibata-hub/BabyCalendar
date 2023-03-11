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
            $table->id()->nullable(false);
            $table->uuid('account_uuid')->nullable(false)->comment('UUID');;
            $table->string('account_name')->nullable(false)->comment('アカウント名');
            $table->string('login_id')->nullable(false)->comment('ログインID');
            $table->string('background_logo')->nullable(true)->comment('バックグラウンド画像');
            $table->string('logo')->nullable(true)->comment('プロフィール画像');
            $table->string('email')->unique()->nullable(false)->comment('登録メールアドレス');
            $table->text('comment')->nullable(true)->comment('ひとことコメント');
            $table->timestamp('email_verified_at')->nullable(true);
            $table->string('password')->nullable(false)->comment('パスワード');
            $table->integer('use_notification_flg')->unsigned()->nullable(false)->comment('通知フラグ');
            $table->integer('user_roll')->unsigned()->nullable(false)->comment('アカウントロール');
            $table->integer('delete_flg')->unsigned()->nullable(false)->comment('削除フラグ');
            $table->rememberToken()->nullable(true);
            $table->timestamp('create_date')->nullable(false)->comment('アカウント作成日時');
            $table->timestamp('update_date')->nullable(false)->comment('アカウント更新日時');
            $table->timestamp('delete_date')->nullable(true)->comment('アカウント削除日時');
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
