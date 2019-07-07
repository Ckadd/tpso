<?php

namespace App\Repository;

use App\model\ContentSharingView;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContentSharingViewRepository {

    protected $contentSharingViewRepository;
    
    public function __construct(ContentSharingView $contentSharingViewRepository)
    {
        $this->contentSharingViewRepository = $contentSharingViewRepository;
    }

    public function addlogByViewPage(int $id){ 
        try{
            return $this->contentSharingViewRepository->insert([
                    'content_id' => $id,
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
            return $this->contentSharingViewRepository->insert([
                    'content_id' => $id,
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
            $contentId = $this->contentSharingViewRepository->select('content_id')
            ->distinct()
            ->get()
            ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId[$val['content_id']] = $this->contentSharingViewRepository
                ->select('id')
                ->where('content_id',$val['content_id'])
                ->where('type','view')
                ->count();
            }
            return $mergeContentId;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogShare() {
        $contentId = $this->contentSharingViewRepository->select('content_id')
            ->distinct()
            ->get()
            ->toArray();
            
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId[$val['content_id']] = $this->contentSharingViewRepository
                ->select('id')
                ->where('content_id',$val['content_id'])
                ->where('type','!=','view')
                ->count();
            }

            return $mergeContentId;
    }

    public function listAllLogById($id) {
        try{
            $type = ['view','facebook','twitter','googleplus'];
            
            foreach($type as $val) { 
                $allLog[$val] = $this->contentSharingViewRepository
                ->select('id')
                ->where('content_id',$id)
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