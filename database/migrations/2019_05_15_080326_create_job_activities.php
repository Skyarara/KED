<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_category_id')->unsigned();
            $table->foreign('job_category_id')->references('id')->on('job_categories');
            $table->bigInteger('station_id')->unsigned();
            $table->foreign('station_id')->references('id')->on('stations');
            $table->string('job');
            $table->string('material');
            $table->date('date');
            $table->bigInteger('user_profile_id')->unsigned();
            $table->foreign('user_profile_id')->references('id')->on('user_profiles');
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
        Schema::dropIfExists('job_activities');
    }
}
