<?php

namespace App\Repository;
use App\Model\PublicGuideView;

class PublicGuideViewRepository {
    
    protected $publicGuideViewRepository;

    public function __construct(PublicGuideView $publicGuideViewRepository) {
        $this->publicGuideViewRepository = $publicGuideViewRepository;
    }

    public function addlogByViewPage($id){
        try{
            return $this->publicGuideViewRepository->insert([
                    'public_guide_id' => $id,
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
            return $this->publicGuideViewRepository->insert([
                    'public_guide_id' => $id,
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
            $contentId = $this->publicGuideViewRepository->select('public_guide_id')
            ->distinct()
            ->get()
            ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId[$val['public_guide_id']] = $this->publicGuideViewRepository
                ->select('id')
                ->where('public_guide_id',$val['public_guide_id'])
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
                $allLog[$val] = $this->publicGuideViewRepository
                ->select('id')
                ->where('public_guide_id',$id)
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