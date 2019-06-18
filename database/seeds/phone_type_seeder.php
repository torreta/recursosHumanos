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
        DB::table('Phone_Types')->insert([
            'name' => 'Hogar'
        ]);

         DB::table('Phone_Types')->insert([
            'name' => 'Trabajo'
        ]);

        DB::table('Phone_Types')->insert([
            'name' => 'Celular'
        ]);

        DB::table('Phone_Types')->insert([
            'name' => 'Personal'
        ]);
    }
}
