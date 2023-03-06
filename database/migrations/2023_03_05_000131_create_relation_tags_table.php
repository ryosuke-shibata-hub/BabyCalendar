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
        Schema::create('relation_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('tag_uuid');
            $table->uuid('question_uuid');
            $table->unique(['question_uuid','tag_uuid']);
            $table->foreign('tag_uuid')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('question_uuid')->references('id')->on('question_boxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_tags');
    }
};
