<?php

namespace App\Repository;
use App\Model\TourStandardView;

class TourStandardViewRepository {
    
    protected $tourStandardViewRepository;

    public function __construct(TourStandardView $tourStandardViewRepository) {
        $this->tourStandardViewRepository = $tourStandardViewRepository;
    }

    public function addlogByViewPage($id){
        try{
            return $this->tourStandardViewRepository->insert([
                'tour_standard_id' => $id,
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
            return $this->tourStandardViewRepository->insert([
                'tour_standard_id' => $id,
                'ip'         => $_SERVER['REMOTE_ADDR'],
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
            $contentId = $this->tourStandardViewRepository->select('tour_standard_id')
                ->distinct()
                ->get()
                ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) {
                $mergeContentId[$val['tour_standard_id']] = $this->tourStandardViewRepository
                    ->select('id')
                    ->where('tour_standard_id',$val['tour_standard_id'])
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
                $allLog[$val] = $this->tourStandardViewRepository
                    ->select('id')
                    ->where('tour_standard_id',$id)
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