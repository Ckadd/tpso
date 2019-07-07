<?php 

namespace App\Repository;
use App\Model\AnnualBudgetView;

class AnnualBudgetViewRepository { 

    protected $annualBudgetView;

    public function __construct(AnnualBudgetView $annualBudgetView) {
        $this->annualBudgetView = $annualBudgetView;
    }

    public function addLogView(int $id, string $type) { 
        try {
            $this->annualBudgetView->insert([
                'annual_id'=> $id,
                'ip' => null,
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
            return $this->annualBudgetView
            ->select('id')->where('annual_id',$id)->where('type','view')->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            $this->annualBudgetView->insert([
                'mission_id'=> $id,
                'ip' => null,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listAllLogSocial(int $id) {
        try {
            $type = ['facebook','twitter','googleplus'];
            
            foreach($type as $val) { 
                $allLog[$val] = $this->annualBudgetView
                ->select('id')
                ->where('mission_id',$id)
                ->where('type',$val)
                ->count();
            }
            $newAllLog['social'] = $allLog;
            return $newAllLog;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}