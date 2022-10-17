<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTimesChangeColumnToNullable extends Migration
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
                $table->time('start_at')->nullable()->change();
                $table->time('pause_at')->nullable()->change();
                $table->time('stop_at')->nullable()->change();
                $table->string('time_stop')->nullable()->change();
                $table->string('time_start')->nullable()->change();
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
        Schema::table('nullable', function (Blueprint $table) {
            //
        });
    }
}
