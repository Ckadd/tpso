<?php

use Illuminate\Database\Seeder;
use App\Traits\SeederTrait;

class InstallOrganizationTableSeeder extends Seeder
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
            $this->info('Table organizations is already exists');
            return;
        }
        
        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertPermissions();
        $this->insertMenuItems();
        $this->success('Seed table organizations is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'organizations')
            ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'organizations',
            'slug' => 'organizations',
            'display_name_singular' => 'Organization',
            'display_name_plural' => 'Organizations',
            'icon' => 'voyager-people',
            'model_name' => 'App\Model\Organization',
            'policy_name' => null,
            'controller' => '',
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
                'data_type_id' => $dataTypeId,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'Created At ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => null,
                'order' => 2,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'detail',
                'type' => 'rich_text_box',
                'display_name' => 'Detail ',
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
                'field' => 'id',
                'type' => 'text',
                'display_name' => 'Id ',
                'required' => 0,
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
                'field' => 'name',
                'type' => 'text',
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
                'field' => 'image_path',
                'type' => 'image',
                'display_name' => 'Image ',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 4,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_user_relationship',
                'type' => 'relationship',
                'display_name' => 'users ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\User',
                    'table' => 'users',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 4,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_news_relationship',
                'type' => 'relationship',
                'display_name' => 'news ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\News',
                    'table' => 'news',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'organization_id',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 8,
            ],
            // [
            //     'field' => 'organization_hasmany_news_relationship',
            //     'data_type_id' => $dataTypeId,
            //     'type' => 'relationship',
            //     'display_name' => 'news',
            //     'required' => 0,
            //     'browse' => 0,
            //     'read' => 0,
            //     'edit' => 0,
            //     'add' => 0,
            //     'delete' => 0,
            //     'details' => '{"model":"App\\Model\\News","table":"news","type":"hasMany","column":"organization_id","key":"id","label":"id","pivot_table":"annual_budget_categories","pivot":"0","taggable":"0"}',
            //     'order' => 8
            // ],
            # add relation to table user
            // [
            //     'data_type_id' => $dataTypeId,
            //     'field' => 'organization_id',
            //     'type' => 'text',
            //     'display_name' => 'Organization Id ',
            //     'required' => 0,
            //     'browse' => 1,
            //     'read' => 1,
            //     'edit' => 1,
            //     'add' => 1,
            //     'delete' => 1,
            //     'details' => null,
            //     'order' => 8,
            // ],
            // [
            //     'data_type_id' => $dataTypeId,
            //     'field' => 'user_belongsto_organization_relationship',
            //     'type' => 'relationship',
            //     'display_name' => 'Organization ',
            //     'required' => 0,
            //     'browse' => 1,
            //     'read' => 1,
            //     'edit' => 1,
            //     'add' => 1,
            //     'delete' => 1,
            //     'details' => json_encode([
            //         'model' => 'App\Model\Organization',
            //         'table' => 'organizations',
            //         'type' => 'belongsTo',
            //         'column' => 'organization_id',
            //         'key' => 'id',
            //         'label' => 'name',
            //         'pivot_table' => 'categories',
            //         'pivot' => '0',
            //         'taggable' => '0'
            //     ]),
            //     'order' => 13,
            // ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_belongsto_department_relationship',
                'type' => 'relationship',
                'display_name' => 'departments ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => json_encode([
                    'model' => 'App\Model\Department',
                    'table' => 'departments',
                    'type' => 'belongsTo',
                    'column' => 'department_id',
                    'key' => 'id',
                    'label' => 'title',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 14,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'department_id',
                'type' => 'hidden',
                'display_name' => 'Department Id ',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => null,
                'order' => 15,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_banner_relationship',
                'type' => 'relationship',
                'display_name' => 'banners',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\Banner',
                    'table' => 'banners',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 16,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_page_organization_relationship',
                'type' => 'relationship',
                'display_name' => 'page_organizations',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\PageOrganization',
                    'table' => 'page_organizations',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 17,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_gallery_relationship',
                'type' => 'relationship',
                'display_name' => 'galleries',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\Gallery',
                    'table' => 'galleries',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 18,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_calendar_detail_relationship',
                'type' => 'relationship',
                'display_name' => 'calendar_details',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\CalendarDetail',
                    'table' => 'calendar_details',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 18,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_service_list_relationship',
                'type' => 'relationship',
                'display_name' => 'service_lists',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\ServiceList',
                    'table' => 'service_lists',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 19,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_form_download_relationship',
                'type' => 'relationship',
                'display_name' => 'form_downloads',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\FormDownload',
                    'table' => 'form_downloads',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 20,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_laws_regulation_relationship',
                'type' => 'relationship',
                'display_name' => 'laws_regulations',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\LawsRegulation',
                    'table' => 'laws_regulations',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 21,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_mapping_newsletter_relationship',
                'type' => 'relationship',
                'display_name' => 'mapping_newsletters',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\MappingNewsletter',
                    'table' => 'mapping_newsletters',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 22,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_ebook_relationship',
                'type' => 'relationship',
                'display_name' => 'ebooks',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\Ebook',
                    'table' => 'ebooks',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 23,
            ],
            [
                'data_type_id' => $dataTypeId,
                'field' => 'organization_hasmany_job_posting_relationship',
                'type' => 'relationship',
                'display_name' => 'job_postings',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => json_encode([
                    'model' => 'App\Model\JobPosting',
                    'table' => 'job_postings',
                    'type' => 'hasMany',
                    'column' => 'organization_id',
                    'key' => 'id',
                    'label' => 'id',
                    'pivot_table' => 'annual_budget_categories',
                    'pivot' => '0',
                    'taggable' => '0'
                ]),
                'order' => 24,
            ],
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertPermissions()
    {
        $permissions = [
            [
                'key' => 'browse_organizations',
                'table_name' => 'organizations'
            ],
            [
                'key' => 'read_organizations',
                'table_name' => 'organizations'
            ],
            [
                'key' => 'edit_organizations',
                'table_name' => 'organizations'
            ],
            [
                'key' => 'add_organizations',
                'table_name' => 'organizations'
            ],
            [
                'key' => 'delete_organizations',
                'table_name' => 'organizations'
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
        $dataOrganization = DB::table('menu_items')->select('id')->where('title','Organizations')->get();
        
        if(!empty($dataOrganization)) {
            DB::table('menu_items')->insert([
                'menu_id' => 1,
                'title' => 'Organizations',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '',
                'parent_id' => null,
                'order' => 5,
                'created_at' => today(),
                'updated_at' => today(),
                'route' => 'voyager.organizations.index',
                'parameters' => ''
            ]);
        }
    }
}
