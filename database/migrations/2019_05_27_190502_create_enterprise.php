<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Enterprise', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->text('name');
            $table->text('description');
            $table->string('rif',50)->unique();
            $table->boolean('authorized');
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
        Schema::dropIfExists('Enterprise');
    }
}
