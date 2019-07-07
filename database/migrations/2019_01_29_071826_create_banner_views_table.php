<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->nullable();
            $table->char('ip',30)->nullable();
            $table->string('type',191)->nullable();
            $table->string('banner_type',191)->nullable();
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
        Schema::dropIfExists('banner_views');
    }
}
