<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCorporateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_corporate_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->string('position')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('mobile')->default(null)->nullable();
            $table->integer('student_experience_id')->unsigned()->default(null)->nullable();
            $table->foreign('student_experience_id')->references('id')->on('student_experience')->onDelete('cascade');
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
        Schema::dropIfExists('student_corporate_contacts');
    }
}
