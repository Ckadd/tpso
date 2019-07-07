<?php

use Illuminate\Database\Seeder;

class InstallChartTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table chartTyoe is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed chartTyoe news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'chart-types')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'chart_types',
            'slug' => 'chart-types',
            'display_name_singular' => 'Chart Type',
            'display_name_plural' => 'Chart Types',
            'icon' => 'voyager-pie-graph',
            'model_name' => 'App\Model\ChartType',
            'policy_name' => null,
            'controller' => 'GraphTypeController',
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
                'type' => 'text',
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
                'details' => '{"validation":{"rule":"integer","messages":{"required":"Please enter sort"}}}',
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
                'field' => 'chart_type_hasmany_chart_list_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'chart_lists',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\ChartList","table":"chart_lists","type":"hasMany","column":"chart_type_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 8
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_chart_types', 'read_chart_types', 'edit_chart_types', 'add_chart_types', 'delete_chart_types'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'chart_types',
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
        $checkMenuChart = DB::table('menu_items')->select('id')->where('title','Chart Generates')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkMenuChart)) { 

            // create main sub menu FAQ
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Chart Generates',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-pie-graph',
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
        
        $dataCharts = DB::table('menu_items')->select('id')->where('title','Chart Generates')->get();
        
        // convert obj to Array
        $dataCharts->transform(function($i) {
            return (array)$i;
        });
        $idMainChart= $dataCharts->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Chart Types',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pie-graph',
                'color' => '#000000',
                'parent_id' => $idMainChart[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.chart-types.index',
                'parameters' => null
            ]
        ]);
    }
}
