<?php

use Illuminate\Database\Seeder;

class InstallContensharingViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table contentsharing-view is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table contentsharing-view is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'content-sharing-views')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'content_sharing_views',
            'slug' => 'content-sharing-views',
            'display_name_singular' => 'Content Sharing View',
            'display_name_plural' => 'Content Sharing Views',
            'icon' => 'voyager-list',
            'model_name' => 'App\Model\ContentSharingView',
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
                'type' => 'text',
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
                'field' => 'content_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Content Id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
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
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
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
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
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
                'field' => 'content_sharing_view_belongsto_content_sharing_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'content_sharings',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\ContentSharing","table":"content_sharings","type":"belongsTo","column":"content_id","key":"id","label":"title","pivot_table":"categories","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_content_sharing_views', 'read_content_sharing_views'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'content_sharing_views',
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
        $dataContent = DB::table('menu_items')->select('id')->where('title','ContentSharing')->get();
        
        // convert obj to Array
        $dataContent->transform(function($i) {
            return (array)$i;
        });
        $idMainContent = $dataContent->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Content Sharings',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => '#000000',
                'parent_id' => $idMainContent[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.content-sharing-views.index',
                'parameters' => null
            ]
        ]);
    }
}
