<?php

use Illuminate\Database\Seeder;

class InstallFaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
            // $this->info('Table news is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table news is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'faqs')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'faqs',
            'slug' => 'faqs',
            'display_name_singular' => 'Faq',
            'display_name_plural' => 'Faqs',
            'icon' => 'voyager-list',
            'model_name' => 'App\Model\Faq',
            'policy_name' => null,
            'controller' => 'FaqsController',
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
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter text"}}}',
                'order' => 2
            ],
            [
                'field' => 'content',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Content',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter text"}}}',
                'order' => 3
            ],
            [
                'field' => 'faq_category_id',
                'data_type_id' => $dataTypeId,
                'type' => 'select_dropdown',
                'display_name' => 'Faq Category Id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => null,
                'order' => 4
            ],
            [
                'field' => 'order',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Order',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required|integer","messages":{"required":"Please enter order number","integer":"please enter number"}}}',
                'order' => 5
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
                'details' => '{"on":"published","off":"Draft","checked":true}',
                'order' => 6
            ],
            [
                'field' => 'is_featured',
                'data_type_id' => $dataTypeId,
                'type' => 'checkbox',
                'display_name' => 'Is Featured',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"on":"yes","off":"no","checked":false}',
                'order' => 7
            ],
            [
                'field' => 'counter',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Counter',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 8
            ],
            [
                'field' => 'user_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'User Id',
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
                'type' => 'hidden',
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
                'type' => 'hidden',
                'display_name' => 'Updated At',
                'required' => 0,
                'browse' => 1,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 11
            ],
            [
                'field' => 'faq_belongsto_faq_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'Category',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\FaqCategory","table":"faq_categories","type":"belongsTo","column":"faq_category_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
                'order' => 12
            ],
            [
                'field' => 'faq_hasmany_faq_view_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'faq_views',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\FaqView","table":"faq_views","type":"hasMany","column":"faq_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 13
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_faqs', 'read_faqs', 'edit_faqs', 'add_faqs', 'delete_faqs'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'faqs',
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

        $idMainFaq = DB::table('menu_items')->select('id')->where('title','FAQ')->get();
        
        // convert obj to Array
        $idMainFaq->transform(function($i) {
            return (array)$i;
        });
        $idMainFaq2 = $idMainFaq->toArray();

        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Faqs',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => '#000000',
                'parent_id' => $idMainFaq2[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.faqs.index',
                'parameters' => null
            ]
        ]);
    }
}
