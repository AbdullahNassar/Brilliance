<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('created_time')->default(null)->nullable();
            $table->string('campaign_name')->default(null)->nullable();
            $table->string('form_name')->default(null)->nullable();
            $table->string('platform')->default(null)->nullable();
            $table->string('full_name')->default(null)->nullable();
            $table->string('job_title')->default(null)->nullable();
            $table->string('company_name')->default(null)->nullable();
            $table->string('phone_number')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->boolean('status')->default(null)->nullable();
            $table->string('activity_status')->default(null)->nullable();
            $table->string('next_call')->default(null)->nullable();
            $table->string('study')->default(null)->nullable();
            $table->string('rate')->default(null)->nullable();
            $table->string('temperature')->default(null)->nullable();
            $table->integer('sales_id')->unsigned()->default(null)->nullable();
            $table->foreign('sales_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('program_id')->unsigned()->default(null)->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->integer('diplom_id')->unsigned()->default(null)->nullable();
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
        Schema::dropIfExists('sales_leads');
    }
}
