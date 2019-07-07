<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->text('content')->nullable();
            $table->integer('faq_category_id')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->tinyInteger('is_featured')->nullable()->default(0);
            $table->integer('counter')->nullable();
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
        Schema::dropIfExists('faqs');
    }
}
