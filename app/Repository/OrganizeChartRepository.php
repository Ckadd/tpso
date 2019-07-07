<?php

namespace App\Repository;

use App\model\OrganizeChart;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrganizeChartRepository { 

    protected $organizaChartRepository;

    public function __construct(OrganizeChart $organizaChartRepository) { 
        $this->organizaChartRepository = $organizaChartRepository;
    }

    public function checkLevelOrganizeChart(int $level) { 
        try{
            $checkLevel = $this->organizaChartRepository->select('id')
            ->where('level',$level)->count();
            return $checkLevel;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function getAllLevel() {
        try {
            
            $getLevel = $this->organizaChartRepository::select('level')
            ->orderBy('level','ASC')->distinct()->get()->toArray();
            $level = array_column($getLevel,'level');
            
            $newData = [];
            foreach($level as $keylevel => $valuelevel) {
                $newData["level".$valuelevel] = $this->organizaChartRepository::where('level',$valuelevel)
                ->where('status',1)
                ->orderBy('sort_order','ASC')->get()->toArray();
            }

            return $newData;

        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listDataById(int $id) {
        try {
            return $this->organizaChartRepository::find($id)->toArray();

        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}