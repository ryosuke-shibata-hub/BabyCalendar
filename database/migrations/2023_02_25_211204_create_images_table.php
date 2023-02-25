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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('account_uuid')->unique()->nullable(false)->comment('ユーザーID');
            $table->string('image_path')->unique()->comment('イメージパス');
            $table->integer('delete_flg')->unsigned()->comment('削除フラグ');
            $table->timestamp('create_date')->nullable(false)->comment('作成日時');
            $table->timestamp('update_date')->nullable(false)->comment('更新日時');
            $table->timestamp('delete_date')->nullable(true)->comment('削除日時');
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
        Schema::dropIfExists('images');
    }
};
