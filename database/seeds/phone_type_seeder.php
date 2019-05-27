<?php

use Illuminate\Database\Seeder;

class phone_type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Phone_Type')->insert([
            'name' => 'Hogar'
        ]);

         DB::table('Phone_Type')->insert([
            'name' => 'Trabajo'
        ]);

        DB::table('Phone_Type')->insert([
            'name' => 'Celular'
        ]);

        DB::table('Phone_Type')->insert([
            'name' => 'Personal'
        ]);
    }
}
