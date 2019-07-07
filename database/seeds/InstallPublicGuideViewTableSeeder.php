<?php

use Illuminate\Database\Seeder;

class InstallPublicGuideViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'public-guide-views')
            ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'public_guide_views',
            'slug' => 'public-guide-views',
            'display_name_singular' => 'Public Guide View',
            'display_name_plural' => 'Public Guide Views',
            'icon' => 'voyager-window-list',
            'model_name' => 'App\Model\PublicGuideView',
            'policy_name' => null,
            'controller' => 'PublicGuideViewController',
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
                'field' => 'public_guide_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Public Guide Id',
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
                'browse' => 1,
                'read' => 1,
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
                'field' => 'public_guide_view_belongsto_public_guide_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'public_guides',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\PublicGuide","table":"public_guides","type":"belongsTo","column":"public_guide_id","key":"id","label":"title","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_public_guide_views', 'read_public_guide_views', 'edit_public_guide_views', 'add_public_guide_views', 'delete_public_guide_views'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'public_guide_views',
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
        $dataContent = DB::table('menu_items')->select('id')->where('title','PublicGuide')->get();

        // convert obj to Array
        $dataContent->transform(function($i) {
            return (array)$i;
        });
        $idMainContent = $dataContent->toArray();

        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Public Guide Views',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => '#000000',
                'parent_id' => $idMainContent[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.public-guide-views.index',
                'parameters' => null
            ]
        ]);
    }
}
