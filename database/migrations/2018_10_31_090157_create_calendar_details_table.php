<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->integer('carlendar_id')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->datetime('datetime')->nullable();
            $table->integer('order')->nullable();
            $table->string('cover_image',191)->nullable();
            $table->string('image',191)->nullable();
            $table->integer('create_by')->nullable();
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
        Schema::dropIfExists('calendar_details');
    }
}
