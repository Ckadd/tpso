<?php

use Illuminate\Database\Seeder;

class CreateLanguages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {

            // $this->info('Table annual_budget_category is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table annual_budget_category is done');
    }

    public function isTableExists()
    {
        return DB::table('languages')
            ->count();
    }

    public function insertToDataTypes()
    {
        \DB::table('languages')->insert(['name' => 'English', 'code' => 'en']);
        \DB::table('languages')->insert(['name' => 'Thai', 'code' => 'th']);
    }


}
