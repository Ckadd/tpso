<?php

use Illuminate\Database\Seeder;

class InstallPagesOraganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table PageOraganization is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table PageOraganization is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'page-organizations')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'page_organizations',
            'slug' => 'page-organizations',
            'display_name_singular' => 'Page Organization',
            'display_name_plural' => 'Page Organizations',
            'icon' => 'voyager-file-text',
            'model_name' => 'App\Model\PageOrganization',
            'policy_name' => null,
            'controller' => 'PageOrganizationController',
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
                'field' => 'page_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Page Id',
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
                'field' => 'organization_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Organization Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 3
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
                'order' => 4
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
                'order' => 5
            ],
            [
                'field' => 'page_organization_belongsto_organization_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'organizations',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Organization","table":"organizations","type":"belongsTo","column":"organization_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 6
            ],
            [
                'field' => 'page_organization_belongsto_page_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'pages',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"TCG\\\\Voyager\\\\Models\\\\Page","table":"pages","type":"belongsToMany","column":"page_id","key":"id","label":"title","pivot_table":"page_organization_pages","pivot":"1","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_page_organizations', 'read_page_organizations', 'edit_page_organizations', 'add_page_organizations', 'delete_page_organizations'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'page_organizations',
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
        $checkMenuPages = DB::table('menu_items')->select('id')->where('title','Pages Menu')->get()->toArray();
        $idOrder = $dataNumOrder->order;

        if(empty($checkMenuPages)) { 

            // create main sub menu Mission
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Pages Menu',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-file-text',
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
        
        
        $dataPagesMenu = DB::table('menu_items')->select('id')->where('title','Pages Menu')->get();
        
        // convert obj to Array
        $dataPagesMenu->transform(function($i) {
            return (array)$i;
        });
        $idMainPageMenu = $dataPagesMenu->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Page Organizations',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => '#000000',
                'parent_id' => $idMainPageMenu[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.page-organizations.index',
                'parameters' => null
            ]
        ]);
    }
}
