<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(null)->nullable();
            $table->string('date')->default(null)->nullable();
            $table->float('egp_amount')->default(null)->nullable();
            $table->float('usd_amount')->default(null)->nullable();
            $table->float('euro_amount')->default(null)->nullable();
            $table->float('egp_paid')->default(null)->nullable();
            $table->float('usd_paid')->default(null)->nullable();
            $table->float('euro_paid')->default(null)->nullable();
            $table->float('egp_balance')->default(null)->nullable();
            $table->float('usd_balance')->default(null)->nullable();
            $table->float('euro_balance')->default(null)->nullable();
            $table->boolean('paid')->default(null)->nullable();
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
        Schema::dropIfExists('student_payment');
    }
}
