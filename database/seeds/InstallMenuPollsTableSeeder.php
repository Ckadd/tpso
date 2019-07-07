<?php

use Illuminate\Database\Seeder;

class InstallMenuPollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table mappingNewletter is already exists');
            return;
        }
        $this->insertToPermission();
        $this->insertMenuItems();
    }

    public function isTableExists()
    {
        return DB::table('menu_items')->where('title', 'Polls')
        ->count();
    }

    public function insertToPermission()
    {
        $keys = ['browse_polls', 'read_polls', 'edit_polls', 'add_polls', 'delete_polls'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'polls',
                'created_at' => now(),
                'updated_at' => now()
            ];

            $permissionId = DB::table('permissions')->insertGetId($permission);

            DB::table('permission_role')->insert([
                'permission_id' => $permissionId,
                'role_id' => 1
            ]);
        }
    }

    public function insertMenuItems()
    {
        $dataPolls = DB::table('menu_items')->select('id')->where('title','Polls')->get();
        
        // convert obj to Array
        $dataPolls->transform(function($i) {
            return (array)$i;
        });
        $idMainPolls = $dataPolls->toArray();
       
        if(empty($idMainPolls)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Polls',
                    'url' => '/admin/polls',
                    'target' => '_self',
                    'icon_class' => 'voyager-bar-chart',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => null,
                    'parameters' => null
                ]
            ]);
        }
    }
}
