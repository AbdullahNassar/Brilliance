<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCorporatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corporates', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(null)->nullable()->after('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('program_id')->unsigned()->default(null)->nullable()->after('status');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->integer('diplom_id')->unsigned()->default(null)->nullable()->after('status');
            $table->foreign('diplom_id')->references('id')->on('diploms')->onDelete('cascade');
            $table->integer('corporate_id')->unsigned()->default(null)->nullable()->after('status');
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable()->after('status');
            $table->foreign('training_course_id')->references('id')->on('training_courses')->onDelete('cascade');
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
