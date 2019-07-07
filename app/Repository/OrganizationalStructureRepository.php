<?php

namespace App\Repository;

use App\model\OrganizationalStructure;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrganizationalStructureRepository { 

    protected $oganizationalStructureRepository;

    public function __construct(OrganizationalStructure $oganizationalStructureRepository) {
        $this->oganizationalStructureRepository = $oganizationalStructureRepository;
    }

    public function listData() {
        try {
                $level['level1'] = $this->listLevel(1);
                $level['level2'] = $this->listLevel(2);
                
                return $level;
            
        }catch(ModelNotFoundException $e) {
            return [];
        }        
    }

    /**
     * list data by level
     *
     * @param integer $level
     * @return void
     */
    public function listLevel(int $level) {

        return $this->oganizationalStructureRepository::where('status',1)
        ->where('level',$level)
        ->orderBy('sort','ASC')
        ->get()->toArray();
    }
}