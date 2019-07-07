<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToLawsRegulations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laws_regulations', function (Blueprint $table) {
            $table->longText('full_description')->nullable();
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
        Schema::table('laws_regulations', function (Blueprint $table) {
            //
        });
    }
}
