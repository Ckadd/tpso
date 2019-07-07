<?php

use Illuminate\Database\Seeder;

class InstallDotStatDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table dotStatData is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table dotStatData is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'dot-stat-datas')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'dot_stat_datas',
            'slug' => 'dot-stat-datas',
            'display_name_singular' => 'Dot Stat Data',
            'display_name_plural' => 'Dot Stat Datas',
            'icon' => 'voyager-company',
            'model_name' => 'App\Model\DotStatData',
            'policy_name' => null,
            'controller' => 'DotStatDataController',
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
                'field' => 'excerpt',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Excerpt',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter excerpt"}}}',
                'order' => 3
            ],
            [
                'field' => 'description',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Description',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter description"}}}',
                'order' => 4
            ],
            [
                'field' => 'file1',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File1',
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
                'field' => 'file2',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File2',
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
                'details' => '{"on":"published","off":"Draft","checked":true}',
                'order' => 7
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
                'details' => '{"default":1,"validation":{"rule":"integer","messages":{"integer":"Please enter sort_order"}}}',
                'order' => 8
            ],
            [
                'field' => 'date',
                'data_type_id' => $dataTypeId,
                'type' => 'date',
                'display_name' => 'Date',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 9
            ],
            [
                'field' => 'created_by',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Created By',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 10
            ],
            [
                'field' => 'stat_cate_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Stat Cate Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 11
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
                'order' => 12
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
                'order' => 13
            ],
            [
                'field' => 'dot_stat_data_belongsto_dot_stat_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'dot_stat_categories',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\DotStatCategory","table":"dot_stat_categories","type":"belongsTo","column":"stat_cate_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 14
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_dot_stat_datas', 'read_dot_stat_datas', 'edit_dot_stat_datas', 'add_dot_stat_datas', 'delete_dot_stat_datas'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'dot_stat_datas',
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
        
        $dataDotSta = DB::table('menu_items')->select('id')->where('title','Dot Stats')->get();
        
        // convert obj to Array
        $dataDotSta->transform(function($i) {
            return (array)$i;
        });
        $idMainDotStat = $dataDotSta->toArray();

        if(!empty($idMainDotStat)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Dot Stat Datas',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-company',
                    'color' => '#000000',
                    'parent_id' => $idMainDotStat[0]['id'],
                    'order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.dot-stat-datas.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
