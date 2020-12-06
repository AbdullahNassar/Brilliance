<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo')->default(null)->nullable();
            $table->string('position')->default(null)->nullable();
            $table->string('department')->default(null)->nullable();
            $table->string('business_unit')->default(null)->nullable();
            $table->string('location')->default(null)->nullable();
            $table->string('employer')->default(null)->nullable();
            $table->string('industry')->default(null)->nullable();
            $table->string('head_count')->default(null)->nullable();
            $table->string('type')->default(null)->nullable();
            $table->string('co_street')->default(null)->nullable();
            $table->string('co_area')->default(null)->nullable();
            $table->string('co_city')->default(null)->nullable();
            $table->string('co_landmark')->default(null)->nullable();
            $table->string('co_country')->default(null)->nullable();
            $table->string('co_website')->default(null)->nullable();
            $table->string('co_email')->default(null)->nullable();
            $table->string('co_mobile')->default(null)->nullable();
            $table->string('co_fax')->default(null)->nullable();
            $table->string('h_street')->default(null)->nullable();
            $table->string('h_area')->default(null)->nullable();
            $table->string('h_city')->default(null)->nullable();
            $table->string('h_landmark')->default(null)->nullable();
            $table->string('h_country')->default(null)->nullable();
            $table->string('h_website')->default(null)->nullable();
            $table->string('h_email')->default(null)->nullable();
            $table->string('h_mobile')->default(null)->nullable();
            $table->string('h_fax')->default(null)->nullable();
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
        Schema::dropIfExists('student_experience');
    }
}
