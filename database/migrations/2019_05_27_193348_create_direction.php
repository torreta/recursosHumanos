<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Direction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('enterprise_id')->nullable();
            $table->foreign('enterprise_id')->references('id')->on('Enterprise');
            $table->bigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->text('country');
            $table->text('adress_line_1');
            $table->text('adress_line_2');
            $table->text('city');
            $table->text('state');
            $table->text('reference');
            $table->text('postal_code');
            $table->bigInteger('direction_type_id');
            $table->foreign('direction_type_id')->references('id')->on('Direction_Type');
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
        Schema::dropIfExists('Direction');
    }
}
