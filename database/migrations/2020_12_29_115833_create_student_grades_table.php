<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attendance')->default(null)->nullable();
            $table->string('assignment')->default(null)->nullable();
            $table->string('final_exam')->default(null)->nullable();
            $table->string('total')->default(null)->nullable();
            $table->string('grade')->default(null)->nullable();
            $table->integer('student_id')->unsigned()->default(null)->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('program_intake_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_intake_id')->references('id')->on('program_intakes')->onDelete('cascade');
            $table->integer('diplom_intake_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_intake_id')->references('id')->on('diplom_intakes')->onDelete('cascade');
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
        Schema::dropIfExists('student_grades');
    }
}
