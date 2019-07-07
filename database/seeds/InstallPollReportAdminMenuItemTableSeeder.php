<?php

use Illuminate\Database\Seeder;

class InstallPollReportAdminMenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Report
        if ($this->isTableExists()) {
            // $this->info('Table news is already exists');
            return;
        }else{
            $this->insertToMenuItems();
        }


    }

    public function isTableExists()
    {
        return DB::table('menu_items')->where('title', 'Report Polls')
            ->count();
    }



    public function insertToMenuItems()
    {
            $mt = DB::table('menu_items')->orderBy('order', 'desc')->first();
            $order = $mt->order + 1;
            return DB::table('menu_items')->insertGetId([
                'menu_id' => 1,
                'title' => 'Report Polls',
                'url' => 'admin/report-polls',
                'target' => '_self',
                'icon_class' => 'voyager-window-list',
                'color' => '#000000',
                'parent_id' => null,
                'order' => $order
            ]);

    }
}
