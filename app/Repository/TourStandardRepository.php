<?php

namespace App\Repository;
use App\Model\TourStandard;

class TourStandardRepository {
    
    protected $tourStandardRepository;

    public function __construct(TourStandard $tourStandardRepository) {
        $this->tourStandardRepository = $tourStandardRepository;
    }

    public function getAll() {
        $data = $this->tourStandardRepository::where('status','=',1)
        ->orderBy('sort_order','ASC')
        ->get()->toArray();
        return $data;
    }

    public function getDataById(int $id) {
        $data = $this->tourStandardRepository::find($id);
        return $data;
    }

}