<?php

namespace App\Repository;

use App\model\Strategic;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StrategicRepository { 

    protected $strategicRepository;

    public function __construct(Strategic $strategicRepository) { 
        $this->strategicRepository = $strategicRepository;
    }

    public function listData() { 
        try{
            $queryData = $this->strategicRepository::where('status',1)->orderBy('sort_order','ASC')->paginate(7);
            $countData = $this->strategicRepository::where('status',1)->orderBy('sort_order','ASC')->count();

            $data['strategicOrderThanFirst'] = $queryData;
            $data['count'] = $countData;
            
            return $data;

        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}