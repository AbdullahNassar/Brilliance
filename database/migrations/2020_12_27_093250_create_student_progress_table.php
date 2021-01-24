<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->default(null)->nullable();
            $table->string('gpa')->default(null)->nullable();
            $table->string('grade')->default(null)->nullable();
            $table->string('status')->default(null)->nullable();
            $table->text('notes')->default(null)->nullable();
            $table->integer('doctor_id')->unsigned()->default(null)->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->integer('student_id')->unsigned()->default(null)->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('student_progress');
    }
}
