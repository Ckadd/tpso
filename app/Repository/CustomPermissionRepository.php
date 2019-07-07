<?php

namespace App\Repository;

use App\Model\User;
use App\Model\Role;
use App\Model\CustomPermission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomPermissionRepository
{
    // protected $userModel;
    // protected $roleModel;
    protected $user;
    protected $role_id;
    protected $table_name;

    public function __construct($table_name)
    {
        // $this->userModel = $userModel;
        // $this->roleModel = $roleModel;
        $this->table_name = $table_name;
        $this->user = \Auth::user();
        $this->role_id = $this->user->role->id;
    }

    /**
     * Questy results by table_name
     * 
     * @param   
     * @return  CustomPermission
     */
    public function getAllResults() {
        return CustomPermission::where('table_name', $this->table_name)
                ->where('role_id', $this->role_id)->get();
    }

    /**
     * Questy results by table_name
     * 
     * @param   string      $category_column_name
     * @return  CustomPermission
     */
    public function getAllResultsByCategoryColumnName($category_column_name) {
        return CustomPermission::where('table_name', $this->table_name)
                ->where('category_column_name', $category_column_name)
                ->where('role_id', $this->role_id)->get();
    }

    /**
     * Get Category Column name
     * 
     * @param   
     * @return  array
     */
    public function getCategoryColumnName() {
        $results = $this->getAllResults();
        $category_column_name = [];
        foreach($results as $result) {
            if ($result->category_column_name && !in_array($result->category_column_name, $category_column_name)) {
                array_push($category_column_name, $result->category_column_name);
            } 
        }
        return $category_column_name;
    }

    /**
     * Check assiged or add customer permission 
     * 
     * @param   
     * @return  boolean
     */
    public function getAssigedCustomPermission() {
        $results = $this->getAllResults();
        
        if ($results->isEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * Check assigned allow ids
     * 
     * @param   
     * @return  boolean     
     */
    public function getAssigedAllowIds() {
        if (!empty($this->getAllowIds())) {
            return true;
        }
        return false;
    }

    /**
     * Get ids for allow by role
     * 
     * @param   
     * @return  array       $allow_ids
     * 
     */
    public function getAllowIds() {
        $results = $this->getAllResults();
            
        $allow_ids = [];
        foreach($results as $result) {
            if ($result->allow_ids) {
                $exs = explode(',', $result->allow_ids);
                foreach ($exs as $id) {
                    array_push($allow_ids, trim($id));
                }
            } 
        }
        
        return $allow_ids;
    }

    /**
     * Check assigned deny ids
     * 
     * @param   
     * @return  boolean     
     */
    public function getAssigedDenyIds() {
        if (!empty($this->getDenyIds())) {
            return true;
        }
        return false;
    }

    /**
     * Get ids for deny by role
     * 
     * @param   
     * @return  array       $deny_ids
     * 
     */
    public function getDenyIds() {
        $results = $this->getAllResults();
            
        $deny_ids = [];
        foreach($results as $result) {
            if ($result->deny_ids) {
                $exs = explode(',', $result->deny_ids);
                foreach ($exs as $id) {
                    array_push($deny_ids, trim($id));
                }
            } 
        }
        
        return $deny_ids;
    }

    /**
     * Check assigned category allow ids
     * 
     * @param   string      $category_column_name
     * @return  boolean     
     */
    public function getAssigedCategoryAllowIds($category_column_name) {
        if (!empty($this->getCategoryAllowIds($category_column_name))) {
            return true;
        }
        return false;
    }

    /**
     * Get ids for allow by category 
     * 
     * @param   string      $category_column_name
     * @return  array       $category_allow_ids
     * 
     */
    public function getCategoryAllowIds($category_column_name) {
        $results = $this->getAllResultsByCategoryColumnName($category_column_name);
        
        $category_allow_ids = [];
        foreach($results as $result) {
            if ($result->category_allow_ids) {
                $exs = explode(',', $result->category_allow_ids);
                foreach ($exs as $id) {
                    array_push($category_allow_ids, trim($id));
                }
            } 
        }
        
        return $category_allow_ids;
    }

    /**
     * Check assigned category deny ids
     * 
     * @param   string      $category_column_name
     * @return  boolean     
     */
    public function getAssigedCategoryDenyIds($category_column_name) {
        if (!empty($this->getCategoryDenyIds($category_column_name))) {
            return true;
        }
        return false;
    }

    /**
     * Get ids for allow by category 
     * 
     * @param   string      $category_column_name
     * @return  array       $category_deny_ids
     * 
     */
    public function getCategoryDenyIds($category_column_name) {
        $results = $this->getAllResultsByCategoryColumnName($category_column_name);
        
        $category_deny_ids = [];
        foreach($results as $result) {
            if ($result->category_deny_ids) {
                $exs = explode(',', $result->category_deny_ids);
                foreach ($exs as $id) {
                    array_push($category_deny_ids, trim($id));
                }
            } 
        }
        
        return $category_deny_ids;
    }
}