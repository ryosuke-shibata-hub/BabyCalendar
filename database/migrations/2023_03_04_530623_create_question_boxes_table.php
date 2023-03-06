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
        Schema::create('question_boxes', function (Blueprint $table) {
            $table->id();
            $table->uuid('question_uuid')->nullable(false)->comment('UUID');
            $table->uuid('account_uuid')->foreignId('account_uuid')->constrained('users')->comment('ユーザーID');
            $table->string('title',255)->comment('質問のタイトル');
            $table->text('body')->comment('質問の内容');
            $table->integer('view_counter')->default(0)->comment('閲覧数');
            $table->integer('delete_flg')->default(0)->comment('削除フラグ');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
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
        Schema::dropIfExists('question_boxes');
    }
};
