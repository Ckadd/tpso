<?php

use Illuminate\Database\Seeder;

class InstallNewletterSubscribeDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table newsletterDetail is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table newsletterDetail is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'newletter-subscribe-details')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'newletter_subscribe_details',
            'slug' => 'newletter-subscribe-details',
            'display_name_singular' => 'Newletter Subscribe Detail',
            'display_name_plural' => 'Newletter Subscribe Details',
            'icon' => 'voyager-mail',
            'model_name' => 'App\Model\NewletterSubscribeDetail',
            'policy_name' => null,
            'controller' => null,
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
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 2
            ],
            [
                'field' => 'newletter_id',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Newletter Id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
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
                'field' => 'newletter_subscribe_detail_belongsto_newsletter_subscribe_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'newsletter_subscribes',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\NewsletterSubscribe","table":"newsletter_subscribes","type":"belongsTo","column":"newletter_id","key":"id","label":"email","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
            [
                'field' => 'newletter_subscribe_detail_hasone_newsletter_category_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'newsletter_categories',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\NewsletterCategory","table":"newsletter_categories","type":"belongsTo","column":"category_id","key":"id","label":"newsletter_title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 8
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_newletter_subscribe_details', 'read_newletter_subscribe_details', 'edit_newletter_subscribe_details', 'add_newletter_subscribe_details', 'delete_newletter_subscribe_details'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'newletter_subscribe_details',
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
                'title' => 'Newletter Subscribe Details',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-mail',
                'color' => '#000000',
                'parent_id' => $idMainNewLetterSubscribe[0]['id'],
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.newletter-subscribe-details.index',
                'parameters' => null
            ]
        ]);
    }
}
