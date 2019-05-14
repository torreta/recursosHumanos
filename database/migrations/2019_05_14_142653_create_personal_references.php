<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Personal_References', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->text('name');
            $table->text('relation');
            $table->text('phone_number');
            $table->bigInteger('curriculum_id');
            $table->foreign('curriculum_id')->references('id')->on('Curriculums');
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
        Schema::dropIfExists('Personal_References');
    }
}
