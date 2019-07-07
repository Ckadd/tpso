<?php

use Illuminate\Database\Seeder;

class InstallMappingNewsletterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table mappingNewletter is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table mappingNewletter is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'mapping-newsletters')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'mapping_newsletters',
            'slug' => 'mapping-newsletters',
            'display_name_singular' => 'Mapping Newsletter',
            'display_name_plural' => 'Mapping Newsletters',
            'icon' => 'voyager-mail',
            'model_name' => 'App\Model\MappingNewsletter',
            'policy_name' => null,
            'controller' => 'MappingNewslteerController',
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
                'field' => 'newsletter_cate_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Newsletter Cate Id',
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
                'field' => 'news_cate_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'News Cate Id',
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
                'field' => 'organization_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Organization Id',
                'required' => 0,
                'browse' => 0,
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
                'details' => '{"default":"1","validation":{"rule":"integer","messages":{"integer":"Please enter sort"}}}',
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
                'field' => 'mapping_newsletter_belongsto_newsletter_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'newsletter_categories',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\NewsletterCategory","table":"newsletter_categories","type":"belongsTo","column":"newsletter_cate_id","key":"id","label":"newsletter_title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 9
            ],
            [
                'field' => 'mapping_newsletter_belongsto_news_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'news_categories',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\NewsCategory","table":"news_categories","type":"belongsTo","column":"news_cate_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 10
            ],
            [
                'field' => 'mapping_newsletter_belongsto_organization_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'organizations',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\Organization","table":"organizations","type":"belongsTo","column":"organization_id","key":"id","label":"name","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 11
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_mapping_newsletters', 'read_mapping_newsletters', 'edit_mapping_newsletters', 'add_mapping_newsletters', 'delete_mapping_newsletters'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'mapping_newsletters',
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
        $dataNewLetterSubscribe = DB::table('menu_items')->select('id')->where('title','NewLetter Subscribe')->get();
        
        // convert obj to Array
        $dataNewLetterSubscribe->transform(function($i) {
            return (array)$i;
        });
        $idMainNewLetterSubscribe = $dataNewLetterSubscribe->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Mapping Newsletters',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-mail',
                'color' => '#000000',
                'parent_id' => $idMainNewLetterSubscribe[0]['id'],
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.mapping-newsletters.index',
                'parameters' => null
            ]
        ]);
    }
}
