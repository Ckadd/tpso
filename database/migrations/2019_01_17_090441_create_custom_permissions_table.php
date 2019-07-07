<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->string('table_name', 255)->nullable();
            $table->text('allow_ids')->nullable();
            $table->text('deny_ids')->nullable();
            $table->string('category_column_name', 255)->nullable();
            $table->text('category_allow_ids')->nullable();
            $table->text('category_deny_ids')->nullable();
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
        Schema::dropIfExists('custom_permissions');
    }
}
