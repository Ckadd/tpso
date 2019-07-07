<?php

namespace App\Repository;
use App\Model\LandmarkStandardView;

class landmarkStandardViewRepository {
    
    protected $landmarkStandardViewRepository;

    public function __construct(LandmarkStandardView $landmarkStandardViewRepository) {
        $this->landmarkStandardViewRepository = $landmarkStandardViewRepository;
    }

    public function addlogByViewPage($id){
        try{
            return $this->landmarkStandardViewRepository->insert([
                'landmark_standard_id' => $id,
                'ip'         => $_SERVER['REMOTE_ADDR'],
                'type'       => 'view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function addlogByShareSocialPage(int $id,string $type){
        try{
            return $this->landmarkStandardViewRepository->insert([
                'landmark_standard_id' => $id,
                'ip'         => '',
                'type'       => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogView() {
        try{
            $contentId = $this->landmarkStandardViewRepository->select('landmark_standard_id')
                ->distinct()
                ->get()
                ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) {
                $mergeContentId[$val['landmark_standard_id']] = $this->landmarkStandardViewRepository
                    ->select('id')
                    ->where('landmark_standard_id',$val['landmark_standard_id'])
                    ->where('type','view')
                    ->count();
            }
            return $mergeContentId;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogById($id) {
        try{
            $type = ['view','facebook','twitter','googleplus'];

            foreach($type as $val) {
                $allLog[$val] = $this->landmarkStandardViewRepository
                    ->select('id')
                    ->where('landmark_standard_id',$id)
                    ->where('type',$val)
                    ->count();
            }
            $newAllLog['social']=$allLog;
            return $newAllLog;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }


}