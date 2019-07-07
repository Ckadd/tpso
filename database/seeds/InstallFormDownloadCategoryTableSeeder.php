<?php

use Illuminate\Database\Seeder;

class InstallFormDownloadCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
            // $this->info('Table form-download is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table form-download is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'form-download-categories')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'form_download_categories',
            'slug' => 'form-download-categories',
            'display_name_singular' => 'Form Download Category',
            'display_name_plural' => 'Form Download Categories',
            'icon' => 'voyager-book-download',
            'model_name' => 'App\Model\FormDownloadCategory',
            'policy_name' => null,
            'controller' => 'FormDownloadCategoryController',
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
                'field' => 'form_download_category_hasmany_form_download_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'form_downloads',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\FormDownload","table":"form_downloads","type":"hasMany","column":"category_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_form_download_categories', 'read_form_download_categories', 'edit_form_download_categories', 'add_form_download_categories', 'delete_form_download_categories'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'form_download_categories',
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
        $checkMenuFormDownload = DB::table('menu_items')->select('id')->where('title','Form Download')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkMenuFormDownload)) { 

            // create main sub menu Contentshring
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Form Download',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-book-download',
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
        
        $dataFormDownload = DB::table('menu_items')->select('id')->where('title','Form Download')->get();
        
        // convert obj to Array
        $dataFormDownload->transform(function($i) {
            return (array)$i;
        });
        $idMainFormDownload = $dataFormDownload->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Form Download Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-book-download',
                'color' => '#000000',
                'parent_id' => $idMainFormDownload[0]['id'],
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.form-download-categories.index',
                'parameters' => null
            ]
        ]);
    }
}
