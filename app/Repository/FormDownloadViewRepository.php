<?php 

namespace App\Repository;
use App\Model\FormDownloadView;

class FormDownloadViewRepository { 

    protected $formDownloadViewRepository;

    public function __construct(FormDownloadView $formDownloadViewRepository) {
        $this->formDownloadViewRepository = $formDownloadViewRepository;
    }

    public function addLogView(string $type,int $organizationId) { 
        try {
            $this->formDownloadViewRepository->insert([
                'form_download_id'=> $organizationId,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function findLogViewByid(int $organizationId) { 
        try {
            return $this->formDownloadViewRepository
            ->select('id')
            ->where('type','view')
            ->where('form_download_id',$organizationId)
            ->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            $this->formDownloadViewRepository->insert([
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
                $allLog[$val] = $this->formDownloadViewRepository
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