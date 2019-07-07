<?php

use Illuminate\Database\Seeder;

class InstallDepartmentMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table departmentMenu is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table departmentMenu is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'department-menus')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'department_menus',
            'slug' => 'department-menus',
            'display_name_singular' => 'Department Menu',
            'display_name_plural' => 'Department Menus',
            'icon' => 'voyager-company',
            'model_name' => 'App\Model\DepartmentMenu',
            'policy_name' => null,
            'controller' => 'DepartmentMenuController',
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
                'browse' => 1,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 1
            ],
            [
                'field' => 'tile',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Tile',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter title"}}}',
                'order' => 2
            ],
            [
                'field' => 'link',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Link',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"#"}',
                'order' => 3
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
                'details' => '{"default":"1","validation":{"rule":"integer","messages":{"integer":"Please enter sort"}}}',
                'order' => 4
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
                'order' => 5
            ],
            [
                'field' => 'parrent_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Parrent Id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 6
            ],
            [
                'field' => 'department_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Department Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 7
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
                'order' => 8
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
                'order' => 9
            ],
            [
                'field' => 'department_menu_belongsto_department_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'departments',
                'required' => 0,
                'browse' => 1,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Department","table":"departments","type":"belongsTo","column":"department_id","key":"id","label":"title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_department_menus', 'read_department_menus', 'edit_department_menus', 'add_department_menus', 'delete_department_menus'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'department_menus',
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
        
        $dataDepartment = DB::table('menu_items')->select('id')->where('title','Department Menu')->get();
        
        // convert obj to Array
        $dataDepartment->transform(function($i) {
            return (array)$i;
        });
        $idMainDepartment = $dataDepartment->toArray();

        if(empty($checkMenuDepartment)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Department Menus',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-company',
                    'color' => '#000000',
                    'parent_id' => $idMainDepartment[0]['id'],
                    'order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.department-menus.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
