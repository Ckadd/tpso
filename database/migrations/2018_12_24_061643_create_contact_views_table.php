<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname',191)->nullable();
            $table->char('id_card',20)->nullable();
            $table->char('phone',29)->nullable();
            $table->string('email',191)->nullable();
            $table->string('title',191)->nullable();
            $table->string('description',191)->nullable();
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
        Schema::dropIfExists('contact_views');
    }
}
