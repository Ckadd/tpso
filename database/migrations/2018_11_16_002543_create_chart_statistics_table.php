<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->integer('stat')->nullable();
            $table->string('unit',191)->nullable();
            $table->string('image',191)->nullable();
            $table->text('detail')->nullable();
            $table->string('stat_cate',191)->nullable();
            $table->dateTime('datetime')->nullable();
            $table->integer('sort_order')->nullable();
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
        Schema::dropIfExists('chart_statistics');
    }
}
