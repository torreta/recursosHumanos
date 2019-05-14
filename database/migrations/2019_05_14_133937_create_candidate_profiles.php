<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Candidate_Profiles', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->bigInteger('identification_type_id');
            $table->string('identification_number',50)->unique();
            $table->BigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('Users');
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
        Schema::dropIfExists('Candidate_Profiles');
    }
}
