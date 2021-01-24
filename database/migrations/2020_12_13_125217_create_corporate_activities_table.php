<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proposal')->default(null)->nullable();
            $table->string('service')->default(null)->nullable();
            $table->string('status')->default(null)->nullable();
            $table->string('next_call')->default(null)->nullable();
            $table->text('notes')->default(null)->nullable();
            $table->integer('user_id')->unsigned()->default(null)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('program_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->integer('diplom_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_id')->references('id')->on('diploms')->onDelete('cascade');
            $table->integer('corporate_id')->unsigned()->default(null)->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('training_course_id')->references('id')->on('training_courses')->onDelete('cascade');
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
        Schema::dropIfExists('corporate_activities');
    }
}
