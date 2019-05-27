<?php

use Illuminate\Database\Seeder;

class direction_type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Direction_Type')->insert([
            'name' => 'Habitación'
        ]);

        DB::table('Direction_Type')->insert([
            'name' => 'Trabajo'
        ]);

        DB::table('Direction_Type')->insert([
            'name' => 'Empresa'
        ]);
    }
}
