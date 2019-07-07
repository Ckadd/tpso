<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;

class MainMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::firstOrCreate([
            'name'=>'top-menu'
        ]);
        Menu::firstOrCreate([
            'name'=>'sub-internalMenu'
        ]);
    }
}
