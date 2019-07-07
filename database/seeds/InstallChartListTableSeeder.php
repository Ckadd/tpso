<?php

use Illuminate\Database\Seeder;

class InstallChartListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table chartList is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed chartList news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'chart-lists')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'chart_lists',
            'slug' => 'chart-lists',
            'display_name_singular' => 'Chart List',
            'display_name_plural' => 'Chart Lists',
            'icon' => 'voyager-pie-graph',
            'model_name' => 'App\Model\ChartList',
            'policy_name' => null,
            'controller' => 'GraphListController',
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
                'field' => 'chart_type_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Chart Type Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 3
            ],
            [
                'field' => 'backgroung_img',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Backgroung Img',
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
                'field' => 'mark_img',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Mark Img',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 5
            ],
            [
                'field' => 'ticklabel',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Ticklabel',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter ticklabel"}}}',
                'order' => 6
            ],
            [
                'field' => 'legend',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Legend',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter legend"}}}',
                'order' => 7
            ],
            [
                'field' => 'color',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Color',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter color"}}}',
                'order' => 8
            ],
            [
                'field' => 'fill_gradient',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Fill Gradient',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter fill gradient"}}}',
                'order' => 9
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
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter sort"}}}',
                'order' => 10
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
                'order' => 11
            ],
            [
                'field' => 'create_by',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Create By',
                'required' => 0,
                'browse' => 0,
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
                'field' => 'chart_list_belongsto_chart_type_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'chart_types',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\ChartType","table":"chart_types","type":"belongsTo","column":"chart_type_id","key":"id","label":"title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 15
            ],
            [
                'field' => 'chart_list_hasmany_chart_data_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'chart_datas',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\ChartList","table":"chart_datas","type":"hasMany","column":"chart_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 16
            ],
            [
                'field' => 'type',
                'data_type_id' => $dataTypeId,
                'type' => 'select_dropdown',
                'display_name' => 'Type',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"option1","options":{"1":"Line Plots","2":"Line Background","3":"Line Marker","4":"Line Area","5":"Bar Plot","6":"Bar 3D","7":"Pie Plot","8":"Pie 3D"}}',
                'order' => 17
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_chart_lists', 'read_chart_lists', 'edit_chart_lists', 'add_chart_lists', 'delete_chart_lists'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'chart_lists',
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
                'title' => 'Chart Lists',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pie-graph',
                'color' => '#000000',
                'parent_id' => $idMainChart[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.chart-lists.index',
                'parameters' => null
            ]
        ]);
    }
}
