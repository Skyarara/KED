<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('permission_id')->nullable();
			$table->unsignedInteger('parent_id')->nullable();
			$table->string('title');
			$table->string('icon')->nullable();
            $table->string('route_name')->nullable();
            $table->timestamps();
        });

        Schema::create('menus_has_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id')->nullable();
            $table->unsignedInteger('permission_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus_has_permission');
        Schema::dropIfExists('menus');
    }
}
