<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMappingLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_langs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('code_lang',191)->nullable();
            $table->string('module',191)->nullable();
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
        Schema::dropIfExists('mapping_langs');
    }
}
