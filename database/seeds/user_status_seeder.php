<?php

use Illuminate\Database\Seeder;

class user_status_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('User_Status')->insert([
            'name' => 'V',
            'description' => 'Usuario Activo'
        ]);
    }
}
