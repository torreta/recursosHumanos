<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Skills', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->text('name');
            $table->text('description');
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
        Schema::dropIfExists('Skills');
    }
}
