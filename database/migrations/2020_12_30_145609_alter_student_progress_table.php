<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStudentProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_progress', function (Blueprint $table) {
            $table->integer('program_course_id')->unsigned()->default(null)->nullable()->after('doctor_id');
            $table->foreign('program_course_id')->references('id')->on('program_courses')->onDelete('cascade');
            $table->integer('diplom_course_id')->unsigned()->default(null)->nullable()->after('doctor_id');
            $table->foreign('diplom_course_id')->references('id')->on('diplom_courses')->onDelete('cascade');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable()->after('doctor_id');
            $table->foreign('training_course_id')->references('id')->on('training_courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
