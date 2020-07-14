<?php

use Illuminate\Database\Seeder;

class UserMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = DB::table('menus')->all();
        // foreach()
    }
}
