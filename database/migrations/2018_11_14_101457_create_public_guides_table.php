<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->nullable();
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('cover_image',191)->nullable();
            $table->string('image',255)->nullable();
            $table->string('file_name',255)->nullable();
            $table->integer('sort_order')->nullable();
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
        Schema::dropIfExists('public_guides');
    }
}
