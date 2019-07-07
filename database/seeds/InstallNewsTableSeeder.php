<?php

use Illuminate\Database\Seeder;
use App\Traits\SeederTrait;
class InstallNewsTableSeeder extends Seeder
{
    use SeederTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
            $this->info('Table news is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->deletePostMenuItem();
        $this->success('Seed table news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'news')
            ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'news',
            'slug' => 'news',
            'display_name_singular' => 'News',
            'display_name_plural' => 'News',
            'icon' => 'voyager-documentation',
            'model_name' => 'App\Model\News',
            'policy_name' => null,
            'controller' => 'NewsController',
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
                'details' => 0,
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
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter short_description"}}}',
                'order' => 3
            ],
            [
                'field' => 'full_desscription',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Full Desscription',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter full_description"}}}',
                'order' => 4
            ],
            [
                'field' => 'cover_image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Cover Image',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 5
            ],
            [
                'field' => 'image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Image',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 6
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
                'order' => 7
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
                'order' => 8
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
                'order' => 9
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
                'order' => 10
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
                'order' => 11
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
                'details' => '{"validation":{"rule":"integer","messages":{"integer":"Please enter Order"}}}',
                'order' => 12
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
                'order' => 13
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
                'order' => 14
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
                'order' => 15
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
                'order' => 16
            ],
            [
                'field' => 'start_date',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'Start Date',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter DateTime"}}}',
                'order' => 17
            ],
            [
                'field' => 'end_date',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'End Date',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter DateTime"}}}',
                'order' => 18
            ],
            [
                'field' => 'create_by',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Create By',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 19
            ],
            [
                'field' => 'slug',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Slug',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 20
            ],
            [
                'field' => 'meta_description',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Meta Description',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 21
            ],
            [
                'field' => 'meta_keywords',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Meta Keywords',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 22
            ],
            [
                'field' => 'created_at',
                'data_type_id' => $dataTypeId,
                'type' => 'timestamp',
                'display_name' => 'Created At',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => null,
                'order' => 20
            ],
            [
                'field' => 'updated_at',
                'data_type_id' => $dataTypeId,            
                'type' => 'timestamp',
                'display_name' => 'Updated At',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 21
            ],
            [
                'field' => 'news_belongsto_news_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'news_categories',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\NewsCategory","table":"news_categories","type":"belongsTo","column":"category_id","key":"id","label":"name","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 22
            ],
            [
                'field' => 'news_belongsto_organization_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'organizations',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Organization","table":"organizations","type":"belongsToMany","column":"organization_id","key":"id","label":"name","pivot_table":"news_organizations","pivot":"1","taggable":"0"}',
                'order' => 23
            ],
            [
                'field' => 'news_hasmany_news_view_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'news_views',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\NewsView","table":"news_views","type":"hasMany","column":"new_id","key":"id","label":"id","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 24
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function deletePostMenuItem()
    {
        return DB::table('menu_items')->where('title', 'Posts')
            ->delete();
    }

    public function insertToPermission()
    {
        $keys = ['browse_news', 'read_news', 'edit_news', 'add_news', 'delete_news'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'news',
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
        $parentId = DB::table('menu_items')->insertGetId([
            'menu_id' => 1,
            'url' => '',
            'icon_class' => 'voyager-news',
            'title' => 'News',
            'color' => '',
            'parent_id' => null,
            'order' => 7,
            'created_at' => now(),
            'updated_at' => now(),
            'route' => null,
            'parameters' => ''
        ]);

        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'News',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-documentation',
                'color' => '',
                'parent_id' => $parentId,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.news.index',
                'parameters' => null
            ],
            [
                'menu_id' => 1,
                'title' => 'Category',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => '#000000',
                'parent_id' => $parentId,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.news-categories.index',
                'parameters' => null
            ],
            [
                'menu_id' => 1,
                'title' => 'News Views',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => '#000000',
                'parent_id' => $parentId,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.news-views.index',
                'parameters' => null
            ]
        ]);
    }
}
