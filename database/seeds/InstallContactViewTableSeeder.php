<?php

use Illuminate\Database\Seeder;

class InstallContactViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table contactlog is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table contactlog is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'contact-views')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'contact_views',
            'slug' => 'contact-views',
            'display_name_singular' => 'Contact View',
            'display_name_plural' => 'Contact Views',
            'icon' => 'voyager-mail',
            'model_name' => 'App\Model\ContactView',
            'policy_name' => null,
            'controller' => 'ContactViewController',
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
                'field' => 'fullname',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Fullname',
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
                'field' => 'id_card',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Id Card',
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
                'field' => 'phone',
                'data_type_id' => $dataTypeId,            
                'type' => 'text',
                'display_name' => 'Phone',
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
                'details' => null,
                'order' => 5
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
                'details' => null,
                'order' => 6
            ],
            [
                'field' => 'description',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Description',
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
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_contact_views', 'read_contact_views'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'contact_views',
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
                'title' => 'Contact Views',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-mail',
                'color' => '#000000',
                'parent_id' => $idMainNewLetterSubscribe[0]['id'],
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.contact-view.index',
                'parameters' => null
            ]
        ]);
    }
}
