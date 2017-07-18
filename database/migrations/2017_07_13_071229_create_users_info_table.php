<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->integer('gender')->default(0)->nullable();
            $table->string('origin')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->text('address')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_info');
    }
}
