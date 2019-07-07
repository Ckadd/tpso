<?php

use Illuminate\Database\Seeder;

class InstallAnnualbudgetTableSeeder extends Seeder
{
    /**
     * Run the annual_budget datatable and datarow seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table annual_budget is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table annual_budget is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'annual-budgets')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'annual_budgets',
            'slug' => 'annual-budgets',
            'display_name_singular' => 'Annual Budget',
            'display_name_plural' => 'Annual Budgets',
            'icon' => 'voyager-download',
            'model_name' => 'App\Model\AnnualBudget',
            'policy_name' => null,
            'controller' => 'AnnualBudgetController',
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
                'field' => 'annual_file',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'Annual File',
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
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter number."}}}',
                'order' => 5
            ],
            [
                'field' => 'annual_category_id',
                'data_type_id' => $dataTypeId,            
                'type' => 'hidden',
                'display_name' => 'Annual Category Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
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
                'field' => 'annual_budget_hasone_annual_budget_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'annual_budget_categories',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\AnnualBudgetCategory","table":"annual_budget_categories","type":"belongsTo","column":"annual_category_id","key":"id","label":"title","pivot_table":"action_plan_categories","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_annual_budgets', 'read_annual_budgets', 'edit_annual_budgets', 'add_annual_budgets', 'delete_annual_budgets'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'annual_budgets',
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
        $checkMenuAnnualBudget = DB::table('menu_items')->select('id')->where('title','AnnualBudget')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkMenuAnnualBudget)) { 

            // create main sub menu Contentshring
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'AnnualBudget',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-download',
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
        
        $dataAnnualBudget = DB::table('menu_items')->select('id')->where('title','AnnualBudget')->get();
        
        // convert obj to Array
        $dataAnnualBudget->transform(function($i) {
            return (array)$i;
        });
        $idMainAnnualBudget = $dataAnnualBudget->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Annual Budgets',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-download',
                'color' => '#000000',
                'parent_id' => $idMainAnnualBudget[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.annual-budgets.index',
                'parameters' => null
            ]
        ]);
    }
}
