<?php

use Illuminate\Database\Seeder;

class InstallOrganizationalStructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table OrganizationalStructure is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table OrganizationalStructure is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'organizational-structures')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'organizational_structures',
            'slug' => 'organizational-structures',
            'display_name_singular' => 'Organizational Structure',
            'display_name_plural' => 'Organizational Structures',
            'icon' => 'voyager-handle',
            'model_name' => 'App\Model\OrganizationalStructure',
            'policy_name' => null,
            'controller' => 'OrganizationalStructureController',
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
                'field' => 'image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Image',
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
                'field' => 'status',
                'data_type_id' => $dataTypeId,
                'type' => 'checkbox',
                'display_name' => 'Status',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"on":"Published","off":"Draft","checked":true}',
                'order' => 3
            ],
            [
                'field' => 'create_by',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Create By',
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
                'field' => 'title',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Title',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 7
            ],
            [
                'field' => 'level',
                'data_type_id' => $dataTypeId,
                'type' => 'select_dropdown',
                'display_name' => 'Level',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"1","options":{"1":"Level1","2":"Level2"}}',
                'order' => 8
            ],
            [
                'field' => 'sort',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Sort',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"1","validation":{"rule":"integer","messages":{"integer":"Please enter order(integer)"}}}',
                'order' => 9
            ],
            [
                'field' => 'link_url',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Link Url',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"#","validation":{"rule":"required","messages":{"required":"Please enter url"}}}',
                'order' => 10
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_organizational_structures', 'read_organizational_structures', 'edit_organizational_structures', 'add_organizational_structures', 'delete_organizational_structures'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'organizational_structures',
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
        $dataNumOrder = DB::table('menu_items')->select('order')->where('parent_id',null)->orderBy('order','DESC')->first();
        $idOrder = $dataNumOrder->order;
        $dataOrganizationalStructures = DB::table('menu_items')->select('id')->where('title','Organizational Structures')->get();
        $dataOrganizationalStructures->transform(function($i) {
            return (array)$i;
        });
        $checkOrganizationalStructures = $dataOrganizationalStructures->toArray();
        if(empty($checkOrganizationalStructures)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Organizational Structures',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-handle',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => $idOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.organizational-structures.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
