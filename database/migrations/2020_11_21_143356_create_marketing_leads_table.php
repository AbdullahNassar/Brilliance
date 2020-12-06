<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_leads', function (Blueprint $table) {
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
            $table->integer('marketing_id')->unsigned()->default(null)->nullable();
            $table->foreign('marketing_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('marketing_leads');
    }
}
