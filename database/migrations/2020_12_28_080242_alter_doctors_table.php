<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->integer('diplom_course_id')->unsigned()->default(null)->nullable()->after('training_course_id');
            $table->foreign('diplom_course_id')->references('id')->on('diplom_courses')->onDelete('cascade');
            $table->integer('diplom_intake_id')->unsigned()->default(null)->nullable()->after('training_course_id');
            $table->foreign('diplom_intake_id')->references('id')->on('diplom_intakes')->onDelete('cascade');

            $table->integer('program_course_id')->unsigned()->default(null)->nullable()->after('training_course_id');
            $table->foreign('program_course_id')->references('id')->on('program_courses')->onDelete('cascade');
            $table->integer('program_intake_id')->unsigned()->default(null)->nullable()->after('training_course_id');
            $table->foreign('program_intake_id')->references('id')->on('program_intakes')->onDelete('cascade');
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
