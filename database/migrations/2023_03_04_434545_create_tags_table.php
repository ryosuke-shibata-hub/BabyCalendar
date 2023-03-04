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
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('tag_id')->comment('TagId');
            $table->uuid('question_uuid')->foreignId('question_uuid')->constrained('question_boxes')->comment('質問ID');
            $table->string('tag_name')->comment('タグネーム');
            $table->unique(['question_id','tag_id'])->comment('ユニーク制約');
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
        Schema::dropIfExists('tags');
    }
};
