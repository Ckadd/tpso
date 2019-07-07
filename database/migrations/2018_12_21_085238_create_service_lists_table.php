<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',191)->nullable();
            $table->string('image',191)->nullable();
            $table->string('link',191)->nullable();
            $table->integer('organization_id')->nullable();
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
        Schema::dropIfExists('service_lists');
    }
}
