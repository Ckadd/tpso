<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('create_by')->nullable();
            $table->string('slug',191)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('departments');
    }
}
