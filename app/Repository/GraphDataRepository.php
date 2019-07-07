<?php

namespace App\Repository;

use App\model\ChartData;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GraphDataRepository { 

    protected $chartModel;

    public function __construct(ChartData $chartModel) { 
        $this->chartModel = $chartModel;
    }

    public function findAllDataById(int $id) { 
        return $this->chartModel->where('chart_id',$id)
        ->get()->toArray();
    }

}