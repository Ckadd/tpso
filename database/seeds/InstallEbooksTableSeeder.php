<?php

use Illuminate\Database\Seeder;

class InstallEbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table ebook is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed ebook news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'ebooks')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'ebooks',
            'slug' => 'ebooks',
            'display_name_singular' => 'Ebook',
            'display_name_plural' => 'Ebooks',
            'icon' => 'voyager-book',
            'model_name' => 'App\Model\Ebook',
            'policy_name' => null,
            'controller' => 'EbooksController',
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
                'order' => 2
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
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter name."}}}',
                'order' => 3
            ],
            [
                'field' => 'file',
                'data_type_id' => $dataTypeId,
                'type' => 'file',
                'display_name' => 'File',
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
                'order' => 5
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
                'order' => 6
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
                'order' => 7
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
                'order' => 8
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
                'order' => 9
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
                'order' => 10
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
                'order' => 11
            ],
            [
                'field' => 'ebook_belongsto_ebook_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'ebook_categories',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\EbookCategory","table":"ebook_categories","type":"belongsTo","column":"category_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 12
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
                'order' => 13
            ],
            [
                'field' => 'ebook_belongstomany_organization_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'organizations',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Organization","table":"organizations","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"ebook_organizations","pivot":"1","taggable":"0"}',
                'order' => 14
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_ebooks', 'read_ebooks', 'edit_ebooks', 'add_ebooks', 'delete_ebooks'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'ebooks',
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
        
        
        $dataEbooks = DB::table('menu_items')->select('id')->where('title','Ebooks')->get();
        
        // convert obj to Array
        $dataEbooks->transform(function($i) {
            return (array)$i;
        });
        $idMainEbooks = $dataEbooks->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Ebooks',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-book',
                'color' => '#000000',
                'parent_id' => $idMainEbooks[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.ebooks.index',
                'parameters' => null
            ]
        ]);
    }
}
