<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sharmindar\Core\Installer\Database\Seeders\DatabaseSeeder as KrayinDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KrayinDatabaseSeeder::class);
    }
}
