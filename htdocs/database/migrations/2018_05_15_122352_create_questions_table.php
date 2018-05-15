<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('question_category_id')->index();
            $table->unsignedInteger('question_section_id')->index();
            $table->string('number');
            $table->text('question');
            $table->text('help_text')->nullable();
            $table->string('field')->unique();
            $table->string('field_type');
            $table->json('options')->nullable();
            $table->string('validation')->nullable();
            $table->unsignedInteger('order');
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
        Schema::dropIfExists('questions');
    }
}
