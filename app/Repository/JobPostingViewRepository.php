<?php 

namespace App\Repository;
use App\Model\JobPostingView;

class JobPostingViewRepository { 

    protected $jobPostingViewRepository;

    public function __construct(JobPostingView $jobPostingViewRepository) {
        $this->jobPostingViewRepository = $jobPostingViewRepository;
    }

    public function addLogView(string $type,int $organizationId) { 
        try {
            $this->jobPostingViewRepository->insert([
                'job_id'=> $organizationId,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function findLogViewByid(int $id) { 
        try {
            return $this->jobPostingViewRepository
            ->select('id')->where('type','view')->where('job_id',$id)->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

}