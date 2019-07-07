<?php 

namespace App\Repository;
use App\Model\TravelTip;

class TravelTipRepository { 
    
    protected $travelTipRepository;

    public function __construct(TravelTip $travelTipRepository) {
        $this->travelTipRepository = $travelTipRepository;
    }

    public function getAll() {
        $data = $this->travelTipRepository::where('status','=',1)
        ->orderBy('sort_order','ASC')
        ->get()->toArray();
        return $data;
    }

    public function getDataById(int $id) {
        $data = $this->travelTipRepository::find($id);
        return $data;
    }

}