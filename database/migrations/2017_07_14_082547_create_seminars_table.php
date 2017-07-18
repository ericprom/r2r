<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('title')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('fiscal_year')->nullable();
            $table->integer('seminar_pdf_id')->unsigned()->index();
            $table->integer('knowledge_pdf_id')->unsigned()->index();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('seminar_pdf_id')->references('id')->on('sources');
            $table->foreign('knowledge_pdf_id')->references('id')->on('sources');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seminars');
    }
}
