<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawsRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laws_regulations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('image_cover')->nullable();
            $table->string('image')->nullable();
            $table->text('file')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->integer('law_category_id')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);;
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
        Schema::dropIfExists('laws_regulations');
    }
}
