<?php

namespace App\Policies;

use App\Model\Page;
use App\Model\User;
use Illuminate\Support\Str;
use App\Model\CustomPermission;
use Illuminate\Support\Facades\DB;
use App\Repository\CustomPermissionRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomPermissionPolicy
{
    use HandlesAuthorization;
    protected $cpr;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle all requested permission checks.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return bool
     */
    public function __call($name, $arguments)
    {
        if (count($arguments) < 2) {
            throw new \InvalidArgumentException('not enough arguments');
        }
        /** @var \TCG\Voyager\Contracts\User $user */
        $user = $arguments[0];

        /** @var $model */
        $model = $arguments[1];

        $dataType = $arguments[2];

        return $this->checkPermission($user, $model, $dataType, $name);
    }

    public function checkPermission($user, $model, $dataType, $name) {
        $table = $model->getTable();
        $id = $model->id;

        $this->cpr = new CustomPermissionRepository($table);

        switch ($name) {
            case 'customPermission.edit':
                return $this->edit($user, $table, $model, $dataType);
                break;
            
            default:
                # code...
                break;
        }

        return false;
    }

    /**
     * When edit 
     * 
     * @param   User    $user
     * @param   string  $table
     * @param   Model   $model
     * 
     * @return  boolean
     */
    public function edit(User $user, $table, $model, $dataType) {
        // Check permission has assigned 

        // Deny Ids
        if ($this->cpr->getAssigedCustomPermission() && $this->cpr->getAssigedDenyIds()) {
            $deny_ids = $this->cpr->getDenyIds();
            if (in_array($model->id, $deny_ids)) {
                return false;
            }
        }

        // Allow Ids
        if ($this->cpr->getAssigedCustomPermission($table) && $this->cpr->getAssigedAllowIds()) {
            $allow_ids = $this->cpr->getAllowIds();
            if (!in_array($model->id, $allow_ids)) {
                return false;
            }
        }

        // Allow/Beny By Category Ids
        if ($this->cpr->getAssigedCustomPermission()) {

            $relationship_belongsToMany_fields = array();
            foreach($dataType->addRows as $row) {
                if ($row->type == 'relationship') {
                    if ($row->details->type == "belongsToMany") {
                        $relationship_belongsToMany_fields[$row->field] = $row;
                    }
                }
            }

            $all_category = $this->cpr->getCategoryColumnName();
            foreach ($all_category as $column_name) {
                // Check basic Columns or has relation ship
                if (!array_key_exists($column_name, $relationship_belongsToMany_fields)) {
                    // Deny By Category Ids
                    if ($this->cpr->getAssigedCategoryDenyIds($column_name)) {
                        $deny_ids = $this->cpr->getCategoryDenyIds($column_name);
                        if (in_array($model->$column_name, $deny_ids)) {
                            return false;
                        }
                    }

                    // Allow By Category Ids
                    if ($this->cpr->getAssigedCategoryAllowIds($column_name)) {
                        $allow_ids = $this->cpr->getCategoryAllowIds($column_name);
                        if (!in_array($model->$column_name, $allow_ids)) {
                            return false;
                        }
                    }
                } else {
                    // Has belongsToMany relationship
                    $row_details = $relationship_belongsToMany_fields[$column_name]->details;
                    $has_many_datas = DB::table($row_details->pivot_table);
                    // Allow By Category Ids
                    if ($this->cpr->getAssigedCategoryAllowIds($column_name)) {
                        $allow_ids = $this->cpr->getCategoryAllowIds($column_name);
                        $has_many_datas->whereIn($row_details->column, $allow_ids);
                    }
                    // Deny By Category Ids
                    if ($this->cpr->getAssigedCategoryDenyIds($column_name)) {
                        $deny_ids = $this->cpr->getCategoryDenyIds($column_name);
                        $has_many_datas->whereNotIn($row_details->column, $allow_ids);
                    }

                    // get all ids for allow/deny
                    $primary_column_name = Str::singular($dataType->name)."_id";
                    $has_many_datas->select($primary_column_name);
                    $has_many_datas = $has_many_datas->get()->toArray();
                    $has_many_datas_ids = (!empty($has_many_datas)) ? array_column($has_many_datas, $primary_column_name) : [];

                    // Allow By Category Ids
                    if ($this->cpr->getAssigedCategoryAllowIds($column_name)) {
                        if (in_array('id', $has_many_datas_ids)) {
                            return false;
                        }
                    }
                    // Deny By Category Ids
                    if ($this->cpr->getAssigedCategoryDenyIds($column_name)) {
                        if (!in_array('id', $has_many_datas_ids)) {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }
}