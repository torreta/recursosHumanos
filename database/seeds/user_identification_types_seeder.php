<?php

use Illuminate\Database\Seeder;

class user_identification_types_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Identification_Types')->insert([
            'name' => 'V'
        ]);

        DB::table('Identification_Types')->insert([
            'name' => 'E'
        ]);

        DB::table('Identification_Types')->insert([
            'name' => 'J'
        ]);

        DB::table('Identification_Types')->insert([
            'name' => 'P'
        ]);

        DB::table('Identification_Types')->insert([
            'name' => 'G'
        ]);
    }
}
