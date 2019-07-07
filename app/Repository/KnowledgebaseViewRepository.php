<?php 

namespace App\Repository;
use App\Model\KnowledgebaseView;

class KnowledgebaseViewRepository { 
    
    protected $knowledgebaseViewRepository;

    public function __construct(KnowledgebaseView $knowledgebaseViewRepository) {
        $this->knowledgebaseViewRepository = $knowledgebaseViewRepository;
    }

    public function addlogByViewPage($id){
        try{
            return $this->knowledgebaseViewRepository->insert([
                    'knowledgebase_id' => $id,
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
            return $this->knowledgebaseViewRepository->insert([
                    'knowledgebase_id' => $id,
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
            $contentId = $this->knowledgebaseViewRepository->select('knowledgebase_id')
            ->distinct()
            ->get()
            ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId[$val['knowledgebase_id']] = $this->knowledgebaseViewRepository
                ->select('id')
                ->where('knowledgebase_id',$val['knowledgebase_id'])
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
                $allLog[$val] = $this->knowledgebaseViewRepository
                ->select('id')
                ->where('knowledgebase_id',$id)
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