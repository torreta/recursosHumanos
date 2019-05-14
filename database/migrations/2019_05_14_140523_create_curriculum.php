<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Curriculums', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->bigInteger('candidate_profile_id')->unique();
            $table->foreign('candidate_profile_id')->references('id')->on('Candidate_Profiles');
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
        Schema::dropIfExists('Curriculums');
    }
}
