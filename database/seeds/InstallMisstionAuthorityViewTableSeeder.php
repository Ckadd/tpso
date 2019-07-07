<?php

use Illuminate\Database\Seeder;

class InstallMisstionAuthorityViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table MisssionAndAuthorityView is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table MisssionAndAuthorityView is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'mission-and-authority-views')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'mission_and_authority_views',
            'slug' => 'mission-and-authority-views',
            'display_name_singular' => 'Mission And Authority View',
            'display_name_plural' => 'Mission And Authority Views',
            'icon' => 'voyager-folder',
            'model_name' => 'App\Model\MissionAndAuthorityView',
            'policy_name' => null,
            'controller' => null,
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => '{"order_column":null,"order_display_column":null}',
            'created_at' => today(),
            'updated_at' => today()
        ]);
    }

    public function insertToDataRows($dataTypeId)
    {
        $rows = [
            [
                'field' => 'id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 1
            ],
            [
                'field' => 'mission_authority_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Mission Authority Id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 2
            ],
            [
                'field' => 'ip',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Ip',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 3
            ],
            [
                'field' => 'type',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Type',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 4
            ],
            [
                'field' => 'created_at',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'Created At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 5
            ],
            [
                'field' => 'updated_at',
                'data_type_id' => $dataTypeId,            
                'type' => 'timestamp',
                'display_name' => 'Updated At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 6
            ],
            [
                'field' => 'mission_and_authority_view_belongsto_mission_and_authority_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'mission_and_authorities',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\MissionAndAuthority","table":"mission_and_authorities","type":"belongsTo","column":"mission_authority_id","key":"id","label":"title","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_mission_and_authority_views', 'read_mission_and_authority_views'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'mission_and_authority_views',
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
        $dataMisssionAuthority = DB::table('menu_items')->select('id')->where('title','Misssion Authority')->get();
        
        // convert obj to Array
        $dataMisssionAuthority->transform(function($i) {
            return (array)$i;
        });
        $idMainMisssionAuthority = $dataMisssionAuthority->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Mission Authrities Views',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-folder',
                'color' => '#000000',
                'parent_id' => $idMainMisssionAuthority[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.mission-and-authority-views.index',
                'parameters' => null
            ]
        ]);
    }
}
