<?php

use Illuminate\Database\Seeder;

class InstallAuditLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isTableExists()) {
           
            // $this->info('Table auditlog is already exists');
            return;
        }

        $dataTypeId = $this->insertToDataTypes();
        $this->insertToDataRows($dataTypeId);
        $this->insertToPermission();
        $this->insertMenuItems();
        // $this->success('Seed table auditlog is done');
    }

    public function isTableExists()
    {
        return DB::table('data_types')->where('slug', 'audit-logs')
        ->count();
    }

    public function insertToDataTypes()
    {
        return DB::table('data_types')->insertGetId([
            'name' => 'audit_logs',
            'slug' => 'audit-logs',
            'display_name_singular' => 'Audit Log',
            'display_name_plural' => 'Audit Logs',
            'icon' => 'voyager-archive',
            'model_name' => 'App\Model\AuditLog',
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
                'field' => 'ip',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Ip',
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
                'order' => 3
            ],
            [
                'field' => 'action',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Action',
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
                'field' => 'datetime',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Datetime',
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
                'field' => 'module',
                'data_type_id' => $dataTypeId,
                'type' => 'hidden',
                'display_name' => 'Module',
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
        ];

        return DB::table('data_rows')->insert($rows);
    }

    public function insertToPermission()
    {
        $keys = ['browse_audit_logs', 'read_audit_logs'];

        foreach ($keys as $key) {
            $permission = [
                'key' => $key,
                'table_name' => 'audit_logs',
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
        $MenuAuditLog = DB::table('menu_items')->select('id')->where('title','Audit Logs')->get();
        $idOrder = $dataNumOrder->order;
        $MenuAuditLog->transform(function($i) {
            return (array)$i;
        });
        $checkMenuAuditLog = $MenuAuditLog->toArray();
        if(empty($checkMenuAuditLog)) {
            DB::table('menu_items')->insert([
                [
                    'menu_id' => 1,
                    'title' => 'Audit Logs',
                    'url' => '',
                    'target' => '_self',
                    'icon_class' => 'voyager-archive',
                    'color' => '#000000',
                    'parent_id' => null,
                    'order' => $idOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'route' => 'voyager.audit-logs.index',
                    'parameters' => null
                ]
            ]);
        }
    }
}
