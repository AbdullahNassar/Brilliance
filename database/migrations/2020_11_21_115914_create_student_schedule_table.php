<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->default(null)->nullable();
            $table->string('type')->default(null)->nullable();
            $table->string('time_from')->default(null)->nullable();
            $table->string('time_to')->default(null)->nullable();
            $table->text('notes')->default(null)->nullable();
            $table->string('service')->default(null)->nullable();
            $table->integer('student_id')->unsigned()->default(null)->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('program_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->integer('program_intake_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_intake_id')->references('id')->on('program_intakes')->onDelete('cascade');
            $table->integer('program_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_course_id')->references('id')->on('program_courses')->onDelete('cascade');
            $table->integer('diplom_intake_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_intake_id')->references('id')->on('diplom_intakes')->onDelete('cascade');
            $table->integer('diplom_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_course_id')->references('id')->on('diplom_courses')->onDelete('cascade');
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
        Schema::dropIfExists('student_schedule');
    }
}
