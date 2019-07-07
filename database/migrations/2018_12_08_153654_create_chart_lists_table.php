<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->integer('chart_type_id')->nullable();
            $table->string('backgroung_img',191)->nullable();
            $table->string('mark_img',191)->nullable();
            $table->string('ticklabel',191)->nullable();
            $table->string('legend',191)->nullable();
            $table->string('color',191)->nullable();
            $table->string('fill_gradient',191)->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('create_by')->nullable();
            $table->timestamps();
            $table->string('type',191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_lists');
    }
}
