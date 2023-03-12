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
        Schema::create('question_comments', function (Blueprint $table) {
            $table->id();
            $table->uuid('account_uuid')->comment('ユーザーid');
            $table->integer('question_id')->comment('投稿id');
            $table->integer('delete_account_uuid')->nullable()->comment('削除者ID');
            $table->integer('update_account_uuid')->nullable()->comment('更新者ID');
            $table->integer('delete_flg');
            $table->text('question_comment')->comment('コメント');
            $table->timestamps();
            $table->softDeletes()->comment('削除日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_comments');
    }
};
