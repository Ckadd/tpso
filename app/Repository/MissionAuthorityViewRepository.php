<?php 

namespace App\Repository;
use App\Model\MissionAndAuthorityView;

class MissionAuthorityViewRepository { 

    protected $missionAuthorityViewRepository;

    public function __construct(MissionAndAuthorityView $missionAuthorityViewRepository) {
        $this->missionAuthorityViewRepository = $missionAuthorityViewRepository;
    }

    public function addLogView(int $id, string $type) { 
        try {
            $this->missionAuthorityViewRepository->insert([
                'mission_authority_id'=> $id,
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
            return $this->missionAuthorityViewRepository
            ->select('id')->where('mission_authority_id',$id)->where('type','view')->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            $this->missionAuthorityViewRepository->insert([
                'mission_authority_id'=> $id,
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
                $allLog[$val] = $this->missionAuthorityViewRepository
                ->select('id')
                ->where('mission_authority_id',$id)
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