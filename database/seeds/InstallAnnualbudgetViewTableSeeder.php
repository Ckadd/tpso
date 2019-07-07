<?php

use Illuminate\Database\Seeder;

class InstallAnnualbudgetViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table articleView is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table articleView is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'annual-budget-views')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'annual_budget_views',
            'slug' => 'annual-budget-views',
            'display_name_singular' => 'Annual Budget View',
            'display_name_plural' => 'Annual Budget Views',
            'icon' => 'voyager-download',
            'model_name' => 'App\Model\AnnualBudgetView',
            'policy_name' => null,
            'controller' => 'AnnualBudgetViewController',
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
                'field' => 'annual_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'annual Id',
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
                'field' => 'ip',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Ip',
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
                'field' => 'annual_budget_view_belongsto_annual_budget_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'annual_budget_categories',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\AnnualBudgetCategory","table":"annual_budget_categories","type":"belongsTo","column":"annual_id","key":"id","label":"id","pivot_table":"action_plan_categories","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_annual_budget_views', 'read_annual_budget_views'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'annual_budget_views',
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
                'title' => 'Annual Budget Views',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-download',
                'color' => '#000000',
                'parent_id' => $idMainAnnualBudget[0]['id'],
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.annual-budget-views.index',
                'parameters' => null
            ]
        ]);
    }
}
