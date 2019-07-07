<?php 

namespace App\Repository;
use App\Model\MissionStatementView;

class MissionStatementViewRepository { 

    protected $missionStatementView;

    public function __construct(MissionStatementView $missionStatementView) {
        $this->missionStatementView = $missionStatementView;
    }

    public function addLogView(int $id, string $type) { 
        try {
            $this->missionStatementView->insert([
                'mission_id'=> $id,
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
            return $this->missionStatementView
            ->select('id')->where('mission_id',$id)->where('type','view')->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            $this->missionStatementView->insert([
                'mission_id'=> $id,
                'ip' => $_SERVER['REMOTE_ADDR'],
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
                $allLog[$val] = $this->missionStatementView
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