<?php

namespace App\Repository;

use App\model\LawRegulationView;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LawRegulationViewRepository { 

    protected $lawsRegulationViewRepository;

    public function __construct(LawRegulationView $lawsRegulationViewRepository) { 
        $this->lawsRegulationViewRepository = $lawsRegulationViewRepository;
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            $this->lawsRegulationViewRepository->insert([
                'law_category_id'=> $id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function findLogViewByid($id) { 
        try {
            return $this->lawsRegulationViewRepository
            ->select('id')->where('law_category_id',$id)->where('type','view')->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}