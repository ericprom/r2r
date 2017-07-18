<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('title')->nullable();
            $table->string('fiscal_year')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->string('researcher')->nullable();
            $table->string('secondry_researcher')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('research_pdf_id')->unsigned()->index();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('research_pdf_id')->references('id')->on('sources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researches');
    }
}
