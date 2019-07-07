<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandardTourismPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_tourism_personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('full_description')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('sort_order')->nullable();
            $table->datetime('datetime')->nullable();
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
        Schema::dropIfExists('standard_tourism_personnels');
    }
}
