<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->unsignedInteger('views_count')->default(0);
	        $table->unsignedInteger('answers_count')->default(0);
	        $table->integer('votes_count')->default(0);
	        $table->unsignedBigInteger('best_answer_id')->nullable();
	        $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->foreign('user_id')
	              ->references('id')
	              ->on('users')
	              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
