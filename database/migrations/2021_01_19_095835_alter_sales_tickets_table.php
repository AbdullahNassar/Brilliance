<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSalesTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_tickets', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(null)->nullable()->after('sales_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('others')->default(null)->nullable()->after('sales_id');
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
