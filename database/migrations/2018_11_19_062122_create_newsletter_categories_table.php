<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('newsletter_title',191)->nullable();
            $table->dateTime('datetime')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('newsletter_categories');
    }
}
