<?php

namespace App\Repository;

use App\Model\Department;

class DepartmentRepository {
    
    protected $department;

    public function __construct(
        Department  $department
    )
    {
        $this->department = $department;
    }

    public function getDepartment() {
        return $this->department::where('title','หน่วยงานภายใน')
        ->where('status',1)
        ->get()->toArray();
    }

    public function getDepartmentById(int $id) {
        return $this->department::where('id',$id)
        ->where('status',1)
        ->get()->toArray();
    }
}
