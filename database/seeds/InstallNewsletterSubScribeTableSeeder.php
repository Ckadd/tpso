<?php

use Illuminate\Database\Seeder;

class InstallNewsletterSubScribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table newsletterSubscribe is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table newsletterSubscribe is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'newsletter-subscribes')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'newsletter_subscribes',
            'slug' => 'newsletter-subscribes',
            'display_name_singular' => 'Newsletter Subscribe',
            'display_name_plural' => 'Newsletter Subscribes',
            'icon' => 'voyager-mail',
            'model_name' => 'App\Model\NewsletterSubscribe',
            'policy_name' => null,
            'controller' => 'NewSletterSubScribesController',
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
                'field' => 'email',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Email',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"email","messages":{"email":"Please enter email."}}}',
                'order' => 2
            ],
            [
                'field' => 'status',
                'data_type_id' => $dataTypeId,
                'type' => 'checkbox',
                'display_name' => 'Status',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"on":"Published","off":"Draft","checked":true}',
                'order' => 3
            ],
            [
                'field' => 'subscribe',
                'data_type_id' => $dataTypeId,
                'type' => 'text_area',
                'display_name' => 'Subscribe',
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
                'order' => 5
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
                'order' => 6
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
                'order' => 7
            ],
            [
                'field' => 'newsletter_subscribe_hasmany_newletter_subscribe_detail_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'newletter_subscribe_details',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\NewletterSubscribeDetail","table":"newletter_subscribe_details","type":"hasMany","column":"newletter_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 8
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_newsletter_subscribes', 'read_newsletter_subscribes', 'edit_newsletter_subscribes', 'add_newsletter_subscribes', 'delete_newsletter_subscribes'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'newsletter_subscribes',
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
        $checkMenuNewletterSubscribe = DB::table('menu_items')->select('id')->where('title','NewLetter Subscribe')->get()->toArray();
        $idOrder = $dataNumOrder->order;
        
        if(empty($checkMenuNewletterSubscribe)) { 

            // create main sub menu Contentshring
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'NewLetter Subscribe',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-mail',
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
        
        $dataNewLetterSubscribe = DB::table('menu_items')->select('id')->where('title','NewLetter Subscribe')->get();
        
        // convert obj to Array
        $dataNewLetterSubscribe->transform(function($i) {
            return (array)$i;
        });
        $idMainNewLetterSubscribe = $dataNewLetterSubscribe->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Newsletter Subscribes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-mail',
                'color' => '#000000',
                'parent_id' => $idMainNewLetterSubscribe[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.newsletter-subscribes.index',
                'parameters' => null
            ]
        ]);
    }
}
