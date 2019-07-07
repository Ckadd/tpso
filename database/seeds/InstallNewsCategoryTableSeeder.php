<?php

use Illuminate\Database\Seeder;
use App\Traits\SeederTrait;

class InstallNewsCategoryTableSeeder extends Seeder
{
    use SeederTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isDataTypeExists('news-categories')) {
            
            $this->info('Table news_categories is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataType();
        $this->insertToDataRow($dataTypeId);
        $this->insertToPermission();

        $this->success('Seed news_categories is done');
    }

    public function insertToDataType()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'news_categories',
            'slug' => 'news-categories',
            'display_name_singular' => 'News Category',
            'display_name_plural' => 'News Categories',
            'icon' => 'voyager-person',
            'model_name' => 'App\Model\NewsCategory',
            'policy_name' => null,
            'controller' => 'NewsCategoryController',
            'description' => null,
            'generate_permissions' => 1,
            'server_side' => 1,
            'details' => '{"order_column":null,"order_display_column":null}',
            'created_at' => today(),
            'updated_at' => today()
        ]);
    }

    public function insertToDataRow($dataTypeId)
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
                'details' => 0,
                'order' => 2
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
                'details' => 0,
                'order' => 3
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
                'details' => 0,
                'order' => 4
            ],
            [
                'field' => 'news_category_hasmany_news_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'news',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\News","table":"news","type":"hasMany","column":"category_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 5
            ],
            [
                'field' => 'news_category_hasmany_mapping_newsletter_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'mapping_newsletters',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\MappingNewsletter","table":"mapping_newsletters","type":"hasMany","column":"news_cate_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
                'order' => 6
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_news_categories', 'read_news_categories', 'edit_news_categories', 'add_news_categories', 'delete_news_categories'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'news_categories',
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
}
