<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from')->default(null)->nullable();
            $table->string('to')->default(null)->nullable();
            $table->string('position')->default(null)->nullable();
            $table->integer('student_id')->unsigned()->default(null)->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('corporate_id')->unsigned()->default(null)->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
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
        Schema::dropIfExists('student_corporate');
    }
}
