<?php

use Illuminate\Database\Seeder;

class InstallDotStatCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table dotStatCategory is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table dotStatCategory is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'dot-stat-categories')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'dot_stat_categories',
            'slug' => 'dot-stat-categories',
            'display_name_singular' => 'Dot Stat Category',
            'display_name_plural' => 'Dot Stat Categories',
            'icon' => 'voyager-company',
            'model_name' => 'App\Model\DotStatCategory',
            'policy_name' => null,
            'controller' => 'DotStatCategoryController',
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
                'field' => 'name',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Name',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter name"}}}',
                'order' => 2
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
                'order' => 3
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
                'order' => 4
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
                'order' => 5
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
                'order' => 6
            ],
            [
                'field' => 'stat_group_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Stat Group Id',
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
                'field' => 'dot_stat_category_belongsto_dot_stat_group_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'dot_stat_groups',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\DotStatGroup","table":"dot_stat_groups","type":"belongsTo","column":"stat_group_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
            [
                'field' => 'dot_stat_category_hasmany_dot_stat_data_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'dot_stat_datas',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\DotStatData","table":"dot_stat_datas","type":"hasMany","column":"stat_cate_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 11
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_dot_stat_categories', 'read_dot_stat_categories', 'edit_dot_stat_categories', 'add_dot_stat_categories', 'delete_dot_stat_categories'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'dot_stat_categories',
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
        $idMainDotStat= $dataDotSta->toArray();

        if(!empty($idMainDotStat)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Dot Stat Categories',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-company',
                    'color' => '#000000',
                    'parent_id' => $idMainDotStat[0]['id'],
                    'order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.dot-stat-categories.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
