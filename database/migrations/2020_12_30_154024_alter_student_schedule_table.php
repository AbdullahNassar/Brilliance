<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStudentScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_schedule', function (Blueprint $table) {
            $table->boolean('attend')->default(null)->nullable()->after('diplom_course_id');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable()->after('diplom_course_id');
            $table->foreign('training_course_id')->references('id')->on('training_courses')->onDelete('cascade');
            $table->integer('doctor_id')->unsigned()->default(null)->nullable()->after('student_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
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
