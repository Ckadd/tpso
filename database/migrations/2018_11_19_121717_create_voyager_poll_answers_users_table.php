<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagerPollAnswersUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyager_poll_answers_users', function (Blueprint $table) {
            $table->integer('answer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['answer_id', 'user_id']);
            $table->string('ip',50)->nullable();
            $table->integer('poll_id')->nullable();
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
        Schema::dropIfExists('voyager_poll_answers_users');
    }
}
