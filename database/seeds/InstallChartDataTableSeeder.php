<?php

use Illuminate\Database\Seeder;

class InstallChartDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table chartData is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed chartData news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'chart-datas')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'chart_datas',
            'slug' => 'chart-datas',
            'display_name_singular' => 'Chart Data',
            'display_name_plural' => 'Chart Datas',
            'icon' => 'voyager-pie-graph',
            'model_name' => 'App\Model\ChartData',
            'policy_name' => null,
            'controller' => 'GraphDataController',
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
                'field' => 'chart_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Chart Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 2
            ],
            [
                'field' => 'data',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Data',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter data"}}}',
                'order' => 3
            ],
            [
                'field' => 'create_by',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Create By',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
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
                'field' => 'chart_data_belongsto_chart_list_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'chart_lists',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\ChartList","table":"chart_lists","type":"belongsTo","column":"chart_id","key":"id","label":"title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_chart_datas', 'read_chart_datas', 'edit_chart_datas', 'add_chart_datas', 'delete_chart_datas'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'chart_datas',
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
        $idMainChart = DB::table('menu_items')->select('id')->where('title','Chart Generates')->get();
        
        // convert obj to Array
        $idMainChart->transform(function($i) {
            return (array)$i;
        });
        $idMainChart = $idMainChart->toArray();

        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Chart Datas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pie-graph',
                'color' => '#000000',
                'parent_id' => $idMainChart[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.chart-datas.index',
                'parameters' => null
            ]
        ]);
    }
}
