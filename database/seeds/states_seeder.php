<?php

use Illuminate\Database\Seeder;

class states_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('States')->insert([
            'name' => 'Amazonas'
        ]);
        DB::table('States')->insert([
            'name' => 'Anzoátegui'
        ]);
        DB::table('States')->insert([
            'name' => 'Apure'
        ]);
        DB::table('States')->insert([
            'name' => 'Aragua'
        ]);
        DB::table('States')->insert([
            'name' => 'Barinas'
        ]);
        DB::table('States')->insert([
            'name' => 'Bolívar'
        ]);
        DB::table('States')->insert([
            'name' => 'Carabobo'
        ]);
        DB::table('States')->insert([
            'name' => 'Cojedes'
        ]);
        DB::table('States')->insert([
            'name' => 'Delta Amacuro'
        ]);
        DB::table('States')->insert([
            'name' => 'Distrito Capital'
        ]);
        DB::table('States')->insert([
            'name' => 'Falcón'
        ]);
        DB::table('States')->insert([
            'name' => 'Guárico'
        ]);
        DB::table('States')->insert([
            'name' => 'Lara'
        ]);
        DB::table('States')->insert([
            'name' => 'Mérida'
        ]);
        DB::table('States')->insert([
            'name' => 'Miranda'
        ]);
        DB::table('States')->insert([
            'name' => 'Monagas'
        ]);
        DB::table('States')->insert([
            'name' => 'Nueva Esparta'
        ]);
        DB::table('States')->insert([
            'name' => 'Portuguesa'
        ]);
        DB::table('States')->insert([
            'name' => 'Sucre'
        ]);
        DB::table('States')->insert([
            'name' => 'Táchira'
        ]);
        DB::table('States')->insert([
            'name' => 'Trujillo'
        ]);
        DB::table('States')->insert([
            'name' => 'Vargas'
        ]);
        DB::table('States')->insert([
            'name' => 'Yaracuy'
        ]);
        DB::table('States')->insert([
            'name' => 'Zulia'
        ]);

    }
}
