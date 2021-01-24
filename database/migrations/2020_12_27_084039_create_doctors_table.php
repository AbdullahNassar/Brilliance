<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->string('image')->default(null)->nullable();
            $table->string('mobile')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('cv')->default(null)->nullable();
            $table->float('total_fees')->default(null)->nullable();
            $table->float('fees_per_day')->default(null)->nullable();
            $table->string('national_id')->default(null)->nullable();
            $table->string('degree')->default(null)->nullable();
            $table->string('major')->default(null)->nullable();
            $table->string('faculty')->default(null)->nullable();
            $table->string('university')->default(null)->nullable();
            $table->string('grade')->default(null)->nullable();
            $table->string('date')->default(null)->nullable();
            $table->string('service')->default(null)->nullable();
            $table->text('notes')->default(null)->nullable();
            $table->integer('program_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->integer('diplom_id')->unsigned()->default(null)->nullable();
            $table->foreign('diplom_id')->references('id')->on('diploms')->onDelete('cascade');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable();
            $table->foreign('training_course_id')->references('id')->on('training_courses')->onDelete('cascade');
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
        Schema::dropIfExists('doctors');
    }
}
