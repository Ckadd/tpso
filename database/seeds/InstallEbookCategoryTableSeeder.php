<?php

use Illuminate\Database\Seeder;

class InstallEbookCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table ebookCategory is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed ebookCategory news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'ebook-categories')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'ebook_categories',
            'slug' => 'ebook-categories',
            'display_name_singular' => 'Ebook Category',
            'display_name_plural' => 'Ebook Categories',
            'icon' => 'voyager-book',
            'model_name' => 'App\Model\EbookCategory',
            'policy_name' => null,
            'controller' => 'EbookCategoryController',
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
                'details' => '{"on":"Published","off":"Draft","checked":true}',
                'order' => 3
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
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter order"}}}',
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
                'field' => 'image_cover',
                'data_type_id' => $dataTypeId,            
                'type' => 'image',
                'display_name' => 'Image Cover',
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
                'field' => 'ebook_category_hasmany_ebook_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'ebooks',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\Ebook","table":"ebooks","type":"hasMany","column":"category_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_ebook_categories', 'read_ebook_categories', 'edit_ebook_categories', 'add_ebook_categories', 'delete_ebook_categories'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'ebook_categories',
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
        $checkMenuEbooks = DB::table('menu_items')->select('id')->where('title','Ebooks')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkMenuEbooks)) { 

            // create main sub menu FAQ
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Ebooks',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-book',
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
        
        $dataEbooks = DB::table('menu_items')->select('id')->where('title','Ebooks')->get();
        
        // convert obj to Array
        $dataEbooks->transform(function($i) {
            return (array)$i;
        });
        $idMainEbooks = $dataEbooks->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Ebook Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-book',
                'color' => '#000000',
                'parent_id' => $idMainEbooks[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.ebook-categories.index',
                'parameters' => null
            ]
        ]);
    }
}
