<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('site_id')->default(0);
            $table->string('title')->default('');
            $table->string('user')->default('');
            $table->text('feedback');
            $table->string('link', 1000)->default('');
            $table->tinyInteger('rating')->default(0);
            $table->bigInteger('author_id')->unsigned()->index()->default(0);
            $table->bigInteger('last_editor_id')->unsigned()->index()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reviews_feedbacks');
    }
}
