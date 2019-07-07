<?php

use Illuminate\Database\Seeder;
use App\Traits\SeederTrait;

class InstallThemeTableSeeder extends Seeder
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
            $this->info('Table themes is already exists');
            return;
        }
        
        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertPermissions();
        $this->insertMenuItems();
        $this->info('Seed table themes is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'themes')
            ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'themes',
            'slug' => 'themes',
            'display_name_singular' => 'Theme',
            'display_name_plural' => 'Themes',
            'icon' => 'voyager-brush',
            'model_name' => 'App\Model\Theme',
            'policy_name' => null,
            'controller' => 'ThemeController',
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => '{"order_column":"created_at","order_display_column":"created_at"}',
            'created_at' => today(),
            'updated_at' => today()
        ]);
    }

    public function insertToDataRows($dataTypeId)
    {
        $rows = [
            [
                'data_type_id' => $dataTypeId,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'Created At ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 2,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'id',
                'type' => 'text',
                'display_name' => 'Id ',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 1,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'is_active',
                'type' => 'checkbox',
                'display_name' => 'Status ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 0,
                'details' => '{"on":"Active","off":"In Active","checked":false}',
                'order' => 5,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'name',
                'type' => 'hidden',
                'display_name' => 'Name ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 3,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'Updated At ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 6,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'user_id',
                'type' => 'hidden',
                'display_name' => 'User Id ',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => null,
                'order' => 7,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'zip_path',
                'type' => 'file',
                'display_name' => 'Theme Zip File ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 1,
                'delete' => 1,
                'details' => '{"is_multiple":false}',
                'order' => 4,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'slug',
                'type' => 'hidden',
                'display_name' => 'Slug ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 5,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'theme_belongsto_user_relationship',
                'type' => 'relationship',
                'display_name' => 'users ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\User',
                    'table' => 'users',
                    'type' => 'belongsTo',
                    'column' => 'user_id',
                    'key' => 'id',
                    'label' => 'name',
                    'pivot_table' => 'categories',
                    'pivot' => 0,
                    'taggable' => 0
                ]),
                'order' => 8,
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertPermissions()
    {
        $permissions = [
            [
                'key' => 'browse_themes',
                'table_name' => 'themes'
            ],
            [
                'key' => 'read_themes',
                'table_name' => 'themes'
            ],
            [
                'key' => 'edit_themes',
                'table_name' => 'themes'
            ],
            [
                'key' => 'add_themes',
                'table_name' => 'themes'
            ],
            [
                'key' => 'delete_themes',
                'table_name' => 'themes'
            ],
        ];


        foreach ($permissions as $permission) {

            $permission['created_at'] = today();
            $permission['updated_at'] = today();
            $permissionId = DB::table('permissions')->insertGetId($permission);

            $permissionRole = [
                'permission_id' => $permissionId,
                'role_id' => 1
            ];

            DB::table('permission_role')->insert($permissionRole);
        }
    }

    public function insertMenuItems()
    {
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'title' => 'Theme',
            'url' => '',
            'target' => '_self',
            'icon_class' => 'voyager-brush',
            'color' => '',
            'parent_id' => null,
            'order' => 6,
            'created_at' => today(),
            'updated_at' => today(),
            'route' => 'voyager.themes.index',
            'parameters' => ''
        ]);
    }

    public function findThemeInDataTypes()
    {
        return DB::table('data_types')->where('slug', 'themes')
            ->first();
    }
}
