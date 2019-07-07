<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('image',191)->nullable();
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
        Schema::dropIfExists('chart_types');
    }
}
