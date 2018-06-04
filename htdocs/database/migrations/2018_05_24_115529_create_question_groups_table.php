<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_section_id')->index();
            $table->unsignedInteger('group_previous_id')->nullable()->index();
            $table->unsignedInteger('group_next_id')->nullable()->index();
            $table->string('slug');
            $table->string('name');
            $table->unsignedInteger('order');
            $table->timestamp('default_at')->nullable();
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
        Schema::dropIfExists('question_groups');
    }
}
