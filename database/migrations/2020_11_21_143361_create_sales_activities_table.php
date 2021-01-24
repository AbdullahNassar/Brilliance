<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default(null)->nullable();
            $table->string('status')->default(null)->nullable();
            $table->string('next_call')->default(null)->nullable();
            $table->text('notes')->default(null)->nullable();
            $table->string('rate')->default(null)->nullable();
            $table->string('temperature')->default(null)->nullable();
            $table->integer('sales_id')->unsigned()->default(null)->nullable();
            $table->foreign('sales_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('sales_lead_id')->unsigned()->default(null)->nullable();
            $table->foreign('sales_lead_id')->references('id')->on('sales_leads')->onDelete('cascade');
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
        Schema::dropIfExists('sales_activities');
    }
}
