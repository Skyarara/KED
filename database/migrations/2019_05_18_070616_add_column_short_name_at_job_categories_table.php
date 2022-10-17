<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnShortNameAtJobCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('job_categories')) {
            Schema::table('job_categories', function (Blueprint $table) {
                $table->string('short_name');
            });
        }
    }

    public function down()
    { }
}
