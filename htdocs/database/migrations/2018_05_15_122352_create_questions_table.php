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
            $table->unsignedInteger('question_group_id')->nullable()->index();
            $table->string('number')->nullable();
            $table->string('label');
            $table->text('question');
            $table->text('help_text')->nullable();
            $table->string('field');
            $table->string('field_type');
            $table->string('validation')->nullable();
            $table->unsignedInteger('order');
            $table->timestamp('hidden_at')->nullable();
            $table->timestamp('mandatory_at')->nullable();
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
