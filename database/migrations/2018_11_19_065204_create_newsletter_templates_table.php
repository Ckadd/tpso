<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('newsletter_category_id')->nullable();
            $table->text('newletter')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('newsletter_templates');
    }
}
