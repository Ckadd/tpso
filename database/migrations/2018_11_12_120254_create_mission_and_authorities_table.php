<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionAndAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_and_authorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->text('full_description')->nullable();
            $table->string('image',191)->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->datetime('datetime')->nullable();
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
        Schema::dropIfExists('mission_and_authorities');
    }
}
