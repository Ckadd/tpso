<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tile')->nullable();
            $table->string('link')->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('parrent_id')->nullable();
            $table->integer('department_id')->nullable();
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
        Schema::dropIfExists('department_menus');
    }
}
