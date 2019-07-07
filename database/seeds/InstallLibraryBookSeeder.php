<?php

use Illuminate\Database\Seeder;

class InstallLibraryBookSeeder extends Seeder
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
        return DB::table('data_types')->where('slug', 'library-books')
            ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'library_books',
            'slug' => 'library-books',
            'display_name_singular' => 'Library Book',
            'display_name_plural' => 'Library Books',
            'icon' => 'voyager-book',
            'model_name' => 'App\Model\LibraryBook',
            'policy_name' => null,
            'controller' => 'LibraryBookController',
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
                'field' => 'short_description',
                'data_type_id' => $dataTypeId,
                'type' => 'rich_text_box',
                'display_name' => 'Short Description',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter short description"}}}',
                'order' => 3
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
                'details' => '{"validation":{"rule":"required","messages":{"required":"Please enter full description"}}}',
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
                'field' => 'cover_image',
                'data_type_id' => $dataTypeId,
                'type' => 'image',
                'display_name' => 'Cover Image',
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
                'order' => 7
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
                'order' => 8
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
                'field' => 'updated_at',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Category Library Book Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => null,
                'order' => 12
            ],
            [
                'field' => 'library_book_hasmany_library_book_view_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'library_book_views',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\LibraryBookView","table":"library_book_views","type":"hasMany","column":"library_book_id","key":"id","label":"id","pivot_table":"annual_budget_views","pivot":"0","taggable":"0"}',
                'order' => 13
            ],
            [
                'field' => 'category_library_book_hasmany_library_book_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'library_books',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '{"model":"App\\\\Model\\\\CategoryLibraryBook","table":"category_library_books","type":"belongsTo","column":"category_library_book_id","key":"id","label":"title","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 14
            ],
            [
                'field' => 'category_library_book_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Category Library Book Id',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 15
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_library_books', 'read_library_books', 'edit_library_books', 'add_library_books', 'delete_library_books'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'library_books',
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
        $checkMenuContent = DB::table('menu_items')->select('id')->where('title','LibraryBook')->get()->toArray();
        $idOrder = $dataNumOrder->order;

        if(empty($checkMenuContent)) {

            // create main menu Contentshring
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'LibraryBook',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-book',
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

        $dataContent = DB::table('menu_items')->select('id')->where('title','LibraryBook')->get();

        // convert obj to Array
        $dataContent->transform(function($i) {
            return (array)$i;
        });
        $idMainContent = $dataContent->toArray();

        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'Library Books',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-book',
                'color' => '#000000',
                'parent_id' => $idMainContent[0]['id'],
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.library-books.index',
                'parameters' => null
            ]
        ]);
    }
}
