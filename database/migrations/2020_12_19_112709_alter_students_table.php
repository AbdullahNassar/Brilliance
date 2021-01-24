<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('type')->default(null)->nullable()->after('name');
            $table->string('source')->default(null)->nullable()->after('name');
            $table->string('source_note')->default(null)->nullable()->after('name');
            $table->float('application_fees')->default(null)->nullable()->after('statement');
            $table->float('discount_rate')->default(null)->nullable()->after('statement');
            $table->float('total_egp')->default(null)->nullable()->after('statement');
            $table->float('total_euro')->default(null)->nullable()->after('statement');
            $table->float('total_usd')->default(null)->nullable()->after('statement');
            $table->text('notes')->default(null)->nullable()->after('statement');
            $table->integer('corporate_id')->unsigned()->default(null)->nullable()->after('statement');
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->integer('training_course_id')->unsigned()->default(null)->nullable()->after('statement');
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
