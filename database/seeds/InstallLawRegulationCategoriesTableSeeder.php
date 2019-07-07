<?php

use Illuminate\Database\Seeder;

class InstallLawRegulationCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table law_regulation_category is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table law_regulation_category is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'laws-regulation-categories')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'laws_regulation_categories',
            'slug' => 'laws-regulation-categories',
            'display_name_singular' => 'Laws Regulation Category',
            'display_name_plural' => 'Laws Regulation Categories',
            'icon' => 'voyager-params',
            'model_name' => 'App\Model\LawsRegulationCategory',
            'policy_name' => null,
            'controller' => 'LawRegulationCategoriesController',
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
                'details' => '{"default":"1","options":{"1":"กฎหมายท่องเที่ยว","2":"กฎหมายที่เกี่ยวข้อง"}}',
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
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter order."}}}',
                'order' => 5
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
                'order' => 6
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
                'field' => 'laws_regulation_category_hasmany_laws_regulation_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'laws_regulations',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\LawsRegulation","table":"laws_regulations","type":"hasMany","column":"law_category_id","key":"id","label":"title","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
            [
                'field' => 'laws_regulation_category_hasmany_law_regulation_view_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'law_regulation_views',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\LawRegulationView","table":"law_regulation_views","type":"hasMany","column":"law_category_id","key":"id","label":"id","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 11
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_laws_regulation_categories', 'read_laws_regulation_categories', 'edit_laws_regulation_categories', 'add_laws_regulation_categories', 'delete_laws_regulation_categories'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'laws_regulation_categories',
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
        $checkMenuLaw = DB::table('menu_items')->select('id')->where('title','Laws Regulartion')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkMenuLaw)) { 

            // create main sub menu Contentshring
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Laws Regulartion',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-params',
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
        
        $dataLawCategory = DB::table('menu_items')->select('id')->where('title','Laws Regulartion')->get();
        
        // convert obj to Array
        $dataLawCategory->transform(function($i) {
            return (array)$i;
        });
        $idMainLawCategory = $dataLawCategory->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Laws Regulation Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-params',
                'color' => '#000000',
                'parent_id' => $idMainLawCategory[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.laws-regulation-categories.index',
                'parameters' => null
            ]
        ]);
    }
}
