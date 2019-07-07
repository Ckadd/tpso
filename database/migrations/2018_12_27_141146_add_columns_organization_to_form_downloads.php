<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOrganizationToFormDownloads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_downloads', function (Blueprint $table) {
            $table->integer('organization_id')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->text('file1')->nullable();
            $table->text('file2')->nullable();
            $table->text('file3')->nullable();
            $table->text('file4')->nullable();
            $table->text('file5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_downloads', function (Blueprint $table) {
            //
        });
    }
}
