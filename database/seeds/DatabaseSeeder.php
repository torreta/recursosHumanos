<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	    $this->call([
        user_identification_types_seeder::class,
        roles_seeder::class,
        user_status_seeder::class,
        user_seeder::class,
        direction_type_seeder::class,
        phone_type_seeder::class,
        states_seeder::class,
    ]);

    }
}
