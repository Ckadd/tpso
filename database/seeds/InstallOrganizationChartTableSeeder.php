<?php

use Illuminate\Database\Seeder;

class InstallOrganizationChartTableSeeder extends Seeder
{
    /**
     * Run the organizationChart datarow and datatype seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table organizationChart is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table organizationChart is done');
    }
    
    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'organize-charts')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'organize_charts',
            'slug' => 'organize-charts',
            'display_name_singular' => 'Organize Chart',
            'display_name_plural' => 'Organize Charts',
            'icon' => 'voyager-company',
            'model_name' => 'App\Model\OrganizeChart',
            'policy_name' => null,
            'controller' => 'OrganizeChartController',
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
                'field' => 'first_name',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'ชื่อ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter firstname."}}}',
                'order' => 2
            ],
            [
                'field' => 'last_name',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'นามสกุล',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter lastname."}}}',
                'order' => 3
            ],
            [
                'field' => 'position',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'ตำแหน่ง',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter position."}}}',
                'order' => 4
            ],
            [
                'field' => 'image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'รูปภาพ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 5
            ],
            [
                'field' => 'level',
                'data_type_id' => $dataTypeId,
                'type' => 'select_dropdown',
                'display_name' => 'level',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"level1","options":{"1":"1","2":"2","3":"3","4":"4","5":"5","6":"6"}}',
                'order' => 6
            ],
            [
                'field' => 'contact',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'ติดต่อ',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter contact."}}}',
                'order' => 7
            ],
            [
                'field' => 'education_history',
                'data_type_id' => $dataTypeId,            
                'type' => 'rich_text_box',
                'display_name' => 'ประวัติการศึกษา',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter education."}}}',
                'order' => 8
            ],
            [
                'field' => 'work_history',
                'data_type_id' => $dataTypeId,            
                'type' => 'rich_text_box',
                'display_name' => 'ประวัติการทำงาน',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter work."}}}',
                'order' => 9
            ],
            [
                'field' => 'train_history',
                'data_type_id' => $dataTypeId,            
                'type' => 'rich_text_box',
                'display_name' => 'ประวัติการฝึกอบรม/สัมมนา/ดูงาน',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter train."}}}',
                'order' => 10
            ],
            [
                'field' => 'insignia_history',
                'data_type_id' => $dataTypeId,            
                'type' => 'rich_text_box',
                'display_name' => 'ประวัติการรับเครื่องราช',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter insignia."}}}',
                'order' => 11
            ],
            [
                'field' => 'create_by',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'ผู้สร้าง',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 12
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
                'order' => 13
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
                'order' => 14
            ],
            [
                'field' => 'sort_order',
                'data_type_id' => $dataTypeId,            
                'type' => 'text',
                'display_name' => 'Sort Order',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":1,"validation":{"rule":"integer","messages":{"integer":"Please enter integer"}}}',
                'order' => 15
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
                'order' => 16
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_organize_charts', 'read_organize_charts', 'edit_organize_charts', 'add_organize_charts', 'delete_organize_charts'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'organize_charts',
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
        $dataOrganizeChart = DB::table('menu_items')->select('id')->where('title','Organize Charts')->get();
        $dataOrganizeChart->transform(function($i) {
            return (array)$i;
        });
        $checkOrganizachart = $dataOrganizeChart->toArray();
        if(empty($checkOrganizachart)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Organize Charts',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-company',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => $idOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.organize-charts.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
