<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->string('name',191)->nullable();
            $table->text('file')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);;
            $table->dateTime('datetime')->nullable();
            $table->integer('sort_order')->nullable();
            $table->integer('create_by')->nullable();
            $table->string('image_cover',191)->nullable();
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
        Schema::dropIfExists('ebooks');
    }
}
