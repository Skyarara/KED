<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTimesAddColumnTimeStartAndTimeStop extends Migration
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
                $table->time('time_start')->after('job_activity_id');
                $table->time('time_stop')->after('time_start');
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
        //
    }
}
