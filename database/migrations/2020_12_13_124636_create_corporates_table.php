<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source')->default(null)->nullable();
            $table->string('source_note')->default(null)->nullable();
            $table->string('name')->default(null)->nullable();
            $table->string('logo')->default(null)->nullable();
            $table->string('industry')->default(null)->nullable();
            $table->string('street')->default(null)->nullable();
            $table->string('area')->default(null)->nullable();
            $table->string('city')->default(null)->nullable();
            $table->string('landmark')->default(null)->nullable();
            $table->string('country')->default(null)->nullable();
            $table->string('website')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('mobile')->default(null)->nullable();
            $table->string('fax')->default(null)->nullable();
            $table->string('status')->default(null)->nullable();
            $table->string('proposal')->default(null)->nullable();
            $table->string('next_call')->default(null)->nullable();
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
        Schema::dropIfExists('corporates');
    }
}
