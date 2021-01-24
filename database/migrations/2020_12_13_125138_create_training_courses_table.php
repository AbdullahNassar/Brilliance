<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->boolean('status')->default(null)->nullable();
            $table->integer('corporate_id')->unsigned()->default(null)->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->default(null)->nullable();
            $table->foreign('category_id')->references('id')->on('training_categories')->onDelete('cascade');
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
        Schema::dropIfExists('training_courses');
    }
}
