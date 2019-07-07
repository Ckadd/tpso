<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',191)->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->text('subscribe')->nullable();
            $table->dateTime('datetime')->nullable();
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
        Schema::dropIfExists('newsletter_subscribes');
    }
}
