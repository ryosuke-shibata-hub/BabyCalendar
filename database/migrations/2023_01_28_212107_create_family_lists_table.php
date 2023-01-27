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
        Schema::create('family_lists', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->foreignId('user_id')->unsigned()->constrained('users');
            $table->string('baby_name')->nullable()->comment('子供の名前');
            $table->string('baby_age')->nullable()->comment('子供の年齢');
            $table->integer('baby_sex')->nullable()->comment('子供の性別');
            $table->binary('logo')->nullable()->comment('プロフィール画像');
            $table->integer('delete_flg')->nullable()->comment('削除フラグ');
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
        Schema::dropIfExists('family_lists');
    }
};