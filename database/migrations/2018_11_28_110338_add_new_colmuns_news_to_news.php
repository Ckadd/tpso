<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColmunsNewsToNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->text('short_description')->nullable();
            $table->text('full_desscription')->nullable();
            $table->string('cover_image',191)->nullable();
            $table->string('image',191)->nullable();
            $table->text('file1')->nullable();
            $table->text('file2')->nullable();
            $table->text('file3')->nullable();
            $table->text('file4')->nullable();
            $table->text('file5')->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('category_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
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
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
}
