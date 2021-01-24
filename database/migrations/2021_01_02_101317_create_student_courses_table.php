<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->default(null)->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('doctor_id')->unsigned()->default(null)->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->integer('program_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_course_id')->references('id')->on('program_courses')->onDelete('cascade');
            $table->integer('diplom_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_course_id')->references('id')->on('diplom_courses')->onDelete('cascade');
            $table->string('status')->default(null)->nullable();
            $table->text('notes')->default(null)->nullable();
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
        Schema::dropIfExists('student_courses');
    }
}
