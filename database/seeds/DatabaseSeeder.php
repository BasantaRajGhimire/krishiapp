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
        $this->call(MonthTableSeeder::class);
        // $this->call(VendorCategory::class);
        $this->command->info('Month table seeded!');
    }
}
