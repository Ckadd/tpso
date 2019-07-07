<?php

use Illuminate\Database\Seeder;

class InstallCustomPermissionTableSeeder extends Seeder
{
    /**
     * Run the custom_permissions datatable and datarow  seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table custom_permissions is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table custom_permissions is done');
    }
    
    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'custom-permissions')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'custom_permissions',
            'slug' => 'custom-permissions',
            'display_name_singular' => 'Custom Permission',
            'display_name_plural' => 'Custom Permissions',
            'icon' => NULL,
            'model_name' => 'App\\Model\\CustomPermission',
            'policy_name' => NULL,
            'controller' => NULL,
            'description' => NULL,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
            'created_at' => today(),
            'updated_at' => today()
        ]);
    }

    public function insertToDataRows($dataTypeId)
    {
        $rows = [
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'id',
                'type' => 'text',
                'display_name' => 'Id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{}',
                'order' => 1,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'role_id',
                'type' => 'text',
                'display_name' => 'Role Id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 3,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'allow_ids',
                'type' => 'text',
                'display_name' => 'Allow Ids Ex : 1,2,3,4',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 5,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'deny_ids',
                'type' => 'text',
                'display_name' => 'Deny Ids Ex : 5,6,7,8',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 6,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'table_name',
                'type' => 'text',
                'display_name' => 'Table Name',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 4,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'Created At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{}',
                'order' => 7,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'Updated At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{}',
                'order' => 8,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'custom_permission_hasone_role_relationship',
                'type' => 'relationship',
                'display_name' => 'Role',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"display_name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 2,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'category_column_name',
                'type' => 'text',
                'display_name' => 'Category Column Name',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 8,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'category_allow_ids',
                'type' => 'text',
                'display_name' => 'Category Allow Ids Ex. 1,2,3,4',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 9,
            ),
            array (
                'data_type_id' => $dataTypeId,
                'field' => 'category_deny_ids',
                'type' => 'text',
                'display_name' => 'Category Deny Ids Ex. 5,6,7,8',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{}',
                'order' => 10,
            )
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_custom_permissions', 'read_custom_permissions', 'edit_custom_permissions', 'add_custom_permissions', 'delete_custom_permissions'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'custom_permissions',
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
        $MenuBanner = DB::table('menu_items')->select('id')->where('title','Banner')->get();
        $idOrder = $dataNumOrder->order;
        $MenuBanner->transform(function($i) {
            return (array)$i;
        });
        $checkMenuBanner = $MenuBanner->toArray();
        if(empty($checkMenuBanner)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Custom Permissions',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-group',
                    'color' => '#000000',
                    'parent_id' => NULL,
                    'order' => $idOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.custom-permissions.index',
                    'parameters' => 'null',
                ]
            ]);
        }
    }
}
