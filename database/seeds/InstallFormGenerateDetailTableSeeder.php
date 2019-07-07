<?php

use Illuminate\Database\Seeder;

class InstallFormGenerateDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table FormGenerateDetail is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table FormGenerateDetail is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'form-generate-details')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'form_generate_details',
            'slug' => 'form-generate-details',
            'display_name_singular' => 'Form Generate Detail',
            'display_name_plural' => 'Form Generate Details',
            'icon' => 'voyager-window-list',
            'model_name' => 'App\Model\FormGenerateDetail',
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
                'field' => 'form_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Form Id',
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
                'order' => 3
            ],
            [
                'field' => 'name',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Name',
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
                'field' => 'value',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Value',
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
                'order' => 6
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
                'order' => 7
            ],
            [
                'field' => 'form_generate_detail_belongsto_form_generate_relationship',
                'data_type_id' => $dataTypeId,            
                'type' => 'relationship',
                'display_name' => 'form_generates',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\FormGenerate","table":"form_generates","type":"belongsTo","column":"form_id","key":"id","label":"form_name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 8
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_form_generate_details', 'read_form_generate_details'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'form_generate_details',
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
        $dataFormGenerate = DB::table('menu_items')->select('id')->where('title','Form Generate')->get();
        
        // convert obj to Array
        $dataFormGenerate->transform(function($i) {
            return (array)$i;
        });
        $idMainFormGenerate = $dataFormGenerate->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Form Generate Details',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-window-list',
                'color' => '#000000',
                'parent_id' => $idMainFormGenerate[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.form-generate-details.index',
                'parameters' => null
            ]
        ]);
    }
}
