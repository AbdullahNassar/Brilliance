<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->string('middle_name')->default(null)->nullable();
            $table->string('last_name')->default(null)->nullable();
            $table->string('gender')->default(null)->nullable();
            $table->string('job')->default(null)->nullable();
            $table->string('image')->default(null)->nullable();
            $table->string('location')->default(null)->nullable();
            $table->string('mobile1')->default(null)->nullable();
            $table->string('mobile2')->default(null)->nullable();
            $table->string('email1')->default(null)->nullable();
            $table->string('email2')->default(null)->nullable();
            $table->string('national_id')->default(null)->nullable();
            $table->string('street')->default(null)->nullable();
            $table->string('area')->default(null)->nullable();
            $table->string('city')->default(null)->nullable();
            $table->string('country')->default(null)->nullable();
            $table->string('em_name')->default(null)->nullable();
            $table->string('em_relation')->default(null)->nullable();
            $table->string('em_mobile')->default(null)->nullable();
            $table->string('em_email')->default(null)->nullable();
            $table->longText('description')->default(null)->nullable();
            $table->longText('group_admission')->default(null)->nullable();
            $table->float('balance')->default(null)->nullable();
            $table->string('reference')->default(null)->nullable();
            $table->string('degree')->default(null)->nullable();
            $table->string('major')->default(null)->nullable();
            $table->string('faculty')->default(null)->nullable();
            $table->string('university')->default(null)->nullable();
            $table->string('grade')->default(null)->nullable();
            $table->string('date')->default(null)->nullable();
            $table->string('statement')->default(null)->nullable();
            $table->integer('program_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->integer('diplom_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_id')->references('id')->on('diploms')->onDelete('cascade');
            $table->integer('university_id')->unsigned()->default(null)->nullable();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
            $table->integer('program_intake_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_intake_id')->references('id')->on('program_intakes')->onDelete('cascade');
            $table->integer('diplom_intake_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_intake_id')->references('id')->on('diplom_intakes')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->default(null)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('service')->default(null)->nullable();
            $table->string('service_note')->default(null)->nullable();
            $table->string('status')->default(null)->nullable();
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
        Schema::dropIfExists('students');
    }
}
