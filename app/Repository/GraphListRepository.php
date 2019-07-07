<?php

namespace App\Repository;

use App\model\ChartList;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GraphListRepository { 

    protected $chartListModel;

    public function __construct(ChartList $chartListModel) { 
        $this->chartListModel = $chartListModel;
    }

    public function findAllDataById(int $id) { 
        return $this->chartListModel->where('id',$id)
        ->where('status',1)
        ->get()->toArray();
    }

}