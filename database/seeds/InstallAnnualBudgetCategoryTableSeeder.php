<?php

use Illuminate\Database\Seeder;

class InstallAnnualBudgetCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table annual_budget_category is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table annual_budget_category is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'annual-budget-categories')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'annual_budget_categories',
            'slug' => 'annual-budget-categories',
            'display_name_singular' => 'Annual Budget Category',
            'display_name_plural' => 'Annual Budget Categories',
            'icon' => 'voyager-news',
            'model_name' => 'App\Model\AnnualBudgetCategory',
            'policy_name' => null,
            'controller' => 'AnnualBudgetCategoryController',
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
                'field' => 'datetime',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'Datetime',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter DateTime"}}}',
                'order' => 3
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
                'field' => 'annual_budget_category_hasmany_annual_budget_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'annual_budgets',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\AnnualBudget","table":"annual_budgets","type":"hasMany","column":"annual_category_id","key":"id","label":"id","pivot_table":"action_plan_categories","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
            [
                'field' => 'annual_budget_category_hasmany_annual_budget_view_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'annual_budget_views',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\AnnualBudgetView","table":"annual_budget_views","type":"hasMany","column":"annual_id","key":"id","label":"id","pivot_table":"action_plan_categories","pivot":"0","taggable":"0"}',
                'order' => 8
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_annual_budget_categories', 'read_annual_budget_categories', 'edit_annual_budget_categories', 'add_annual_budget_categories', 'delete_annual_budget_categories'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'annual_budget_categories',
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
        $dataAnnualBudget = DB::table('menu_items')->select('id')->where('title','AnnualBudget')->get();
        
        // convert obj to Array
        $dataAnnualBudget->transform(function($i) {
            return (array)$i;
        });
        $idMainAnnualBudget = $dataAnnualBudget->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Annual Budget Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-download',
                'color' => '#000000',
                'parent_id' => $idMainAnnualBudget[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.annual-budget-categories.index',
                'parameters' => null
            ]
        ]);
    }
}
