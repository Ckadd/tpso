<?php

namespace App\Repository;

use App\Model\DepartmentMenu;

class DepartmentMenuRepository {

    protected $departmentMenuModel;

    public function __construct(
        DepartmentMenu $departmentMenuModel
    ){
        $this->departmentMenuModel = $departmentMenuModel;
    }

    public function listMenuByDepartmentId(int $id) {
        $menuParrent = $this->departmentMenuModel->where('department_id',$id)
        ->where('parrent_id',NULL)
        ->where('status',1)
        ->orderBy('sort','ASC')
        ->get()->toArray();
        
        $mergeMenu = [];
        foreach($menuParrent as $key => $value) {
            $menuChild['menusub'] = $this->departmentMenuModel->where('department_id',$id)
            ->where('parrent_id',$value['id'])
            ->where('status',1)
            ->orderBy('sort','ASC')
            ->get()->toArray();
            
            ($menuChild) == [] ? $mergeMenu[] = $value : $mergeMenu[] = array_merge($menuParrent[$key],$menuChild);
        }
        return $mergeMenu;
    }
}