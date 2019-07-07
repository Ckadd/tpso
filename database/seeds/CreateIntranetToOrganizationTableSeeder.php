<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreateIntranetToOrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if($this->isTableExists()) {
            return;
        }
        $this->createIntranet();
    }

    public function isTableExists()
    {
        return DB::table('organizations')->where('name','intranet')->count();
    }

    public function createIntranet()
    {
        return DB::table('organizations')->insert([
            'name' => 'intranet',
            'detail' => '<p>intranet</p>',
            'image_path' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}