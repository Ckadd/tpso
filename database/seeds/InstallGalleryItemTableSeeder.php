<?php

use Illuminate\Database\Seeder;

class InstallGalleryItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table galleryitem is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table galleryitem is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'gallery-items')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'gallery_items',
            'slug' => 'gallery-items',
            'display_name_singular' => 'Gallery Item',
            'display_name_plural' => 'Gallery Items',
            'icon' => 'voyager-images',
            'model_name' => 'App\Model\GalleryItem',
            'policy_name' => null,
            'controller' => 'GalleryItemController',
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
                'field' => 'gallery_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Gallery Id',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 2
            ],
            [
                'field' => 'image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Image',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"max:1000","messages":{"max":"\u0e02\u0e19\u0e32\u0e14\u0e40\u0e01\u0e34\u0e19 1mb"}}}',
                'order' => 3
            ],
            [
                'field' => 'caption',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Caption',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter caption."}}}',
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
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter number."}}}',
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
                'details' => null,
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
                'order' => 9
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
                'order' => 10
            ],
            [
                'field' => 'gallery_item_belongsto_gallery_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'galleries',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Gallery","table":"galleries","type":"belongsTo","column":"gallery_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 11
            ],
            [
                'field' => 'short_description',
                'data_type_id' => $dataTypeId,
                'type' => 'text_area',
                'display_name' => 'Short Description',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter short_description."}}}',
                'order' => 12
            ],
            [
                'field' => 'full_description',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Full Description',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter full_description."}}}',
                'order' => 13
            ],
            [
                'field' => 'link_url',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Link Url',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"default":"#"}',
                'order' => 14
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_gallery_items', 'read_gallery_items', 'edit_gallery_items', 'add_gallery_items', 'delete_gallery_items'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'gallery_items',
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
        
        $dataGallerys = DB::table('menu_items')->select('id')->where('title','Gallerys')->get();
        
        // convert obj to Array
        $dataGallerys->transform(function($i) {
            return (array)$i;
        });
        $idMainGallerys = $dataGallerys->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Gallery Items',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => '#000000',
                'parent_id' => $idMainGallerys[0]['id'],
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.gallery-items.index',
                'parameters' => null
            ]
        ]);
    }
}
