<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->string('middle_name')->default(null)->nullable();
            $table->string('last_name')->default(null)->nullable();
            $table->string('gender')->default(null)->nullable();
            $table->string('job')->default(null)->nullable();
            $table->string('image')->default(null)->nullable();
            $table->string('mobile1')->default(null)->nullable();
            $table->string('mobile2')->default(null)->nullable();
            $table->string('email1')->default(null)->nullable();
            $table->string('email2')->default(null)->nullable();
            $table->string('national_id')->default(null)->nullable();
            $table->string('street')->default(null)->nullable();
            $table->string('area')->default(null)->nullable();
            $table->string('city')->default(null)->nullable();
            $table->string('country')->default(null)->nullable();
            $table->string('join_date')->default(null)->nullable();
            $table->string('leave_date')->default(null)->nullable();
            $table->float('balance')->default(null)->nullable();
            $table->float('salary')->default(null)->nullable();
            $table->string('degree')->default(null)->nullable();
            $table->string('major')->default(null)->nullable();
            $table->string('faculty')->default(null)->nullable();
            $table->string('university')->default(null)->nullable();
            $table->string('grade')->default(null)->nullable();
            $table->string('date')->default(null)->nullable();
            $table->integer('user_id')->unsigned()->default(null)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('employees');
    }
}
