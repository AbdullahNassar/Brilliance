<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_schedule', function (Blueprint $table) {
            $table->integer('hall_id')->unsigned()->default(null)->nullable()->after('student_id');
            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
        });

        Schema::table('doctor_schedule', function (Blueprint $table) {
            $table->integer('hall_id')->unsigned()->default(null)->nullable()->after('doctor_id');
            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
