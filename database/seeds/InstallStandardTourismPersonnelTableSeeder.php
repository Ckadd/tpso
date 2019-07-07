<?php

use Illuminate\Database\Seeder;

class InstallStandardTourismPersonnelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table library is standardtourismpersonnel exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table standardtourismpersonnel is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'standard-tourism-personnels')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'standard_tourism_personnels',
            'slug' => 'standard-tourism-personnels',
            'display_name_singular' => 'Standard Tourism Personnel',
            'display_name_plural' => 'Standard Tourism Personnels',
            'icon' => 'voyager-anchor',
            'model_name' => 'App\Model\StandardTourismPersonnel',
            'policy_name' => null,
            'controller' => 'StandardTourismPersonnelController',
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
                'field' => 'title',
                'data_type_id' => $dataTypeId,
                'type' => 'text_area',
                'display_name' => 'Title',
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
                'field' => 'full_description',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Full Description',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter full_description"}}}',
                'order' => 3
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
                'order' => 4
            ],
            [
                'field' => 'sort_order',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Order',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter order"}}}',
                'order' => 5
            ],
            [
                'field' => 'datetime',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'Datetime',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter DateTime"}}}',
                'order' => 6
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
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_standard_tourism_personnels', 'read_standard_tourism_personnels', 'edit_standard_tourism_personnels', 'add_standard_tourism_personnels', 'delete_standard_tourism_personnels'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'standard_tourism_personnels',
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
        $dataStandardTourismPersonnel = DB::table('menu_items')->select('id')->where('title','Standard Tourism Personnels')->get();
        $dataStandardTourismPersonnel->transform(function($i) {
            return (array)$i;
        });
        $checkStandardTourismPersonnel = $dataStandardTourismPersonnel->toArray();
        if(empty($checkStandardTourismPersonnel)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Standard Tourism Personnels',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-anchor',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => $idOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.standard-tourism-personnels.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
