<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplom_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->integer('credits')->default(null)->nullable();
            $table->integer('diplom_id')->unsigned()->default(null)->nullable();
            $table->integer('active')->default(null)->nullable();
            $table->foreign('diplom_id')->references('id')->on('diploms')->onDelete('cascade');
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
        Schema::dropIfExists('diplom_cources');
    }
}
