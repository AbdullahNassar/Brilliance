<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorProgramCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_program_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_course_id')->references('id')->on('program_courses')->onDelete('cascade');
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
        Schema::dropIfExists('doctor_program_courses');
    }
}
