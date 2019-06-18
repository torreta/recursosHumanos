<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociatedTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Associated_To', function (Blueprint $table) {
            $table->bigInteger('enterprise_id');
            $table->foreign('enterprise_id')->references('id')->on('Enterprises');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('Users');
            $table->timestamps();

            $table->primary(['enterprise_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Associated_To');
    }
}
