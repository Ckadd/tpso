<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDotStatDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dot_stat_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->text('file1')->nullable();
            $table->text('file2')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('sort_order')->nullable();
            $table->date('date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('stat_cate_id')->nullable();
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
        Schema::dropIfExists('dot_stat_datas');
    }
}
