<?php

use Illuminate\Database\Seeder;

class InstallChartStatisticTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table chart-statistic is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table chart-statistic is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'chart-statistics')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'chart_statistics',
            'slug' => 'chart-statistics',
            'display_name_singular' => 'Chart Statistic',
            'display_name_plural' => 'Chart Statistics',
            'icon' => 'voyager-pie-chart',
            'model_name' => 'App\Model\ChartStatistic',
            'policy_name' => null,
            'controller' => 'ChartStatisticController',
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
                'field' => 'stat',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Stat',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter stat"}}}',
                'order' => 3
            ],
            [
                'field' => 'unit',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Unit',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter unit"}}}',
                'order' => 4
            ],
            [
                'field' => 'image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Image',
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
                'field' => 'detail',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Detail',
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
                'field' => 'stat_cate',
                'data_type_id' => $dataTypeId,
                'type' => 'select_dropdown',
                'display_name' => 'Stat Cate',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"สถิติมาตรฐานการท่องเที่ยวไทย/มาตรฐานอาเซียน","options":{"1":"สถิติมาตรฐานการท่องเที่ยวไทย/มาตรฐานอาเซียน","2":"สถิติผู้ประกอบธุรกิจนำเที่ยว","3":"สถิติจำนวนแหล่งท่องเที่ยว","4":"สถิติการถ่ายทำภาพยนตร์ต่างประเทศในประเทศไทย","5":"สถิติจำนวนบุคลากรวิชาการท่องเที่ยวอาเซียนในแผนกแม่บ้านที่ได้รับการรับรองแล้ว"}}',
                'order' => 7
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
                'order' => 8
            ],
            [
                'field' => 'sort_order',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Sort Order',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter order"}}}',
                'order' => 9
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
                'order' => 10
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
                'order' => 11
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_chart_statistics', 'read_chart_statistics', 'edit_chart_statistics', 'add_chart_statistics', 'delete_chart_statistics'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'chart_statistics',
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
        $MenuChartStatistic = DB::table('menu_items')->select('id')->where('title','Chart Statistics')->get();
        $idOrder = $dataNumOrder->order;
        $MenuChartStatistic->transform(function($i) {
            return (array)$i;
        });
        $checkMenuChartStatistic = $MenuChartStatistic->toArray();
        if(empty($checkMenuChartStatistic)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Chart Statistics',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-pie-chart',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => $idOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.chart-statistics.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
