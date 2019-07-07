<?php

use Illuminate\Database\Seeder;

class InstallFormGenerateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table FormGenerate is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table FormGenerate is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'form-generates')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'form_generates',
            'slug' => 'form-generates',
            'display_name_singular' => 'Form Generate',
            'display_name_plural' => 'Form Generates',
            'icon' => 'voyager-file-text',
            'model_name' => 'App\Model\FormGenerate',
            'policy_name' => null,
            'controller' => 'FormGenerateController',
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
                'field' => 'form_name',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Form Name',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter name."}}}',
                'order' => 2
            ],
            [
                'field' => 'form',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Form',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 3
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
                'field' => 'sort_order',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Sort Order',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
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
            [
                'field' => 'form_generate_hasmany_form_generate_detail_relationship',
                'data_type_id' => $dataTypeId,            
                'type' => 'relationship',
                'display_name' => 'form_generate_details',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\FormGenerateDetail","table":"form_generate_details","type":"hasMany","column":"form_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
            [
                'field' => 'start_date',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'Start Date',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 11
            ],
            [
                'field' => 'end_date',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'End Date',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 12
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_form_generates', 'read_form_generates', 'edit_form_generates', 'add_form_generates', 'delete_form_generates'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'form_generates',
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
        $checkFormGenerate = DB::table('menu_items')->select('id')->where('title','Form Generate')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkFormGenerate)) { 

            // create main sub menu FAQ
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Form Generate',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-file-text',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => $idOrder + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => null,
                    'parameters' => null
                ]
            ]);
        }
        
        $dataFormGenerate = DB::table('menu_items')->select('id')->where('title','Form Generate')->get();
        
        // convert obj to Array
        $dataFormGenerate->transform(function($i) {
            return (array)$i;
        });
        $idMainFormGenerate = $dataFormGenerate->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Form Generates',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => '#000000',
                'parent_id' => $idMainFormGenerate[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.form-generates.index',
                'parameters' => null
            ]
        ]);
    }
}
