<?php

use Illuminate\Database\Seeder;

class InstallFormDownloadTableSeeder extends Seeder
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
        return DB::table('data_types')->where('slug', 'form-downloads')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'form_downloads',
            'slug' => 'form-downloads',
            'display_name_singular' => 'Form Download',
            'display_name_plural' => 'Form Downloads',
            'icon' => 'voyager-book-download',
            'model_name' => 'App\Model\FormDownload',
            'policy_name' => null,
            'controller' => 'FormDownloadController',
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
                'field' => 'file',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File',
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
                'order' => 7
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
                'order' => 8
            ],
            [
                'field' => 'form_download_hasone_form_download_view_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'form_download_views',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\FormDownloadView","table":"form_download_views","type":"hasMany","column":"form_download_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 9
            ],
            [
                'field' => 'form_download_belongsto_organization_relationship',
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
                'order' => 10
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
                'order' => 11
            ],
            [
                'field' => 'short_description',
                'data_type_id' => $dataTypeId,
                'type' => 'text_area',
                'display_name' => 'Short Description',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 12
            ],
            [
                'field' => 'full_description',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Full Description',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 13
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
                'details' => null,
                'order' => 14
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
                'order' => 15
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
                'order' => 16
            ],
            [
                'field' => 'file3',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File3',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 17
            ],
            [
                'field' => 'file4',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File4',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 18
            ],
            [
                'field' => 'file5',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File5',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 19
            ],
            [
                'field' => 'category_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Category Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 20
            ],
            [
                'field' => 'form_download_belongsto_form_download_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'Category',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\FormDownloadCategory","table":"form_download_categories","type":"belongsTo","column":"category_id","key":"id","label":"title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 21
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_form_downloads', 'read_form_downloads', 'edit_form_downloads', 'add_form_downloads', 'delete_form_downloads'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'form_downloads',
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
                'title' => 'Form Downloads',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-book-download',
                'color' => '#000000',
                'parent_id' => $idMainFormDownload[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.form-downloads.index',
                'parameters' => null
            ]
        ]);
    }
}
