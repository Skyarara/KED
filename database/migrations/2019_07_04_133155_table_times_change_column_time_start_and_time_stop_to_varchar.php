<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTimesChangeColumnTimeStartAndTimeStopToVarchar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('times')) {
            Schema::table('times', function (Blueprint $table) {
                $table->string('time_start')->change();
                $table->string('time_stop')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('varchar', function (Blueprint $table) {
            //
        });
    }
}
