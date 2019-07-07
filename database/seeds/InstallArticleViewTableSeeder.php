<?php

use Illuminate\Database\Seeder;

class InstallArticleViewTableSeeder extends Seeder
{
    /**
     * Run the articlesView datatable and datarow seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table articleView is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table articleView is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'article-views')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'article_views',
            'slug' => 'article-views',
            'display_name_singular' => 'Article View',
            'display_name_plural' => 'Article Views',
            'icon' => 'voyager-receipt',
            'model_name' => 'App\Model\ArticleView',
            'policy_name' => null,
            'controller' => 'ArticleViewController',
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
                'field' => 'article_id',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'article Id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 2
            ],
            [
                'field' => 'ip',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Ip',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
                'order' => 3
            ],
            [
                'field' => 'type',
                'data_type_id' => $dataTypeId,
                'type' => 'text',
                'display_name' => 'Type',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => null,
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
                'field' => 'article_view_belongsto_article_relationship',
                'data_type_id' => $dataTypeId,
                'type' => 'relationship',
                'display_name' => 'articles',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '{"model":"App\\\\Model\\\\Article","table":"articles","type":"belongsTo","column":"article_id","key":"id","label":"title","pivot_table":"article_views","pivot":"0","taggable":"0"}',
                'order' => 7
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_article_views', 'read_article_views'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'article_views',
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
        $dataArticle = DB::table('menu_items')->select('id')->where('title','Article')->get();
        
        // convert obj to Array
        $dataArticle->transform(function($i) {
            return (array)$i;
        });
        $idMainArticle = $dataArticle->toArray();
        
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'title' => 'article Views',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-receipt',
                'color' => '#000000',
                'parent_id' => $idMainArticle[0]['id'],
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'route' => 'voyager.article-views.index',
                'parameters' => null
            ]
        ]);
    }
}
