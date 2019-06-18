<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('enterprise_id')->nullable();
            $table->foreign('enterprise_id')->references('id')->on('Enterprises');
            $table->bigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->text('phone_number');
            $table->bigInteger('phone_type_id');
            $table->foreign('phone_type_id')->references('id')->on('Phone_Types');
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
        Schema::dropIfExists('Phones');
    }
}
