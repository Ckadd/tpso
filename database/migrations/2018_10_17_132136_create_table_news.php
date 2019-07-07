<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('images')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(0);
            $table->datetime('published_at')->nullable();
            $table->string('featured_image')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('news');
    }
}
