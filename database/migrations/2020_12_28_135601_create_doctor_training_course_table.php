<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTrainingCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_training_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('training_course_id')->references('id')->on('training_courses')->onDelete('cascade');
            $table->integer('doctor_id')->unsigned()->default(null)->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
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
        Schema::dropIfExists('doctor_training_courses');
    }
}
