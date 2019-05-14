<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users_Roles', function (Blueprint $table) {
            $table->bigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('Roles');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('Users');
            $table->timestamps();

            $table->primary(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Users_Roles');
    }
}
