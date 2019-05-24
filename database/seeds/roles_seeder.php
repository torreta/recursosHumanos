<?php

use Illuminate\Database\Seeder;

class roles_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('Roles')->insert([
            'role_name' => 'Candidato'
        ]);

        DB::table('Roles')->insert([
            'role_name' => 'Admin'
        ]);

        DB::table('Roles')->insert([
            'role_name' => 'Moderador'
        ]);
    }
}
