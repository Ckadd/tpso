<?php

namespace App\Repository;

use App\model\JobPosting;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
use App\Model\JobPostOrganization;
class JobPostingRepository { 

    protected $jobPostingRepository;

    public function __construct(JobPosting $jobPostingRepository) { 
        $this->jobPostingRepository = $jobPostingRepository;
    }

    public function listDataById($id) {
        try{
            return $this->jobPostingRepository->select('file')
            ->where('id',$id)->get()->toArray();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listDetailById($id) {
        try{
            $queryData = $this->jobPostingRepository->leftJoin('mapping_langs', 'job_postings.id', '=', 'mapping_langs.master_id');
            $queryData->where('job_postings.id',$id);
            $queryData->where('mapping_langs.code_lang',App::getLocale());
            $queryData->where('mapping_langs.module','job-postings');
            $queryData->select('job_postings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first();
            if(!empty($queryData)){
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('job_postings', 'mapping_langs.master_id', '=', 'job_postings.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->select('job_postings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('job_postings', 'mapping_langs.master_id', '=', 'job_postings.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->select('job_postings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();

                if(!empty($queryData)) {
                    $queryData = $queryData->toArray();
                }
                
            }

            if(empty($queryData)){
                $queryData = $this->jobPostingRepository->leftJoin('mapping_langs', 'job_postings.id', '=', 'mapping_langs.master_id');
                $queryData->where('job_postings.id',$id);
                $queryData->where('mapping_langs.code_lang','th');
                $queryData->where('mapping_langs.module','job-postings');
                $queryData->select('job_postings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                $queryData = $queryData->first()->toArray();
            }

            return $queryData;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function lastContent() {
        
        return $this->jobPostingRepository
                ->orderBy('datetime','desc')
                ->take(1)->get()->toArray();
    }

    /**
     * list data by Organization id
     *
     * @param integer $organizationId
     * @return void
     */
    public function getDataByOrganization(int $organizationId) {

        $queryJobpostingId = JobPostOrganization::select('job_posting_id')->where('organization_id',$organizationId)->get()->toArray();
        $allIdJobpostingId = (!empty($queryJobpostingId)) ? array_column($queryJobpostingId,'job_posting_id') : [];
        $queryJob = $this->jobPostingRepository->leftJoin('mapping_langs', 'job_postings.id', '=', 'mapping_langs.master_id');
        $queryJob->where('mapping_langs.code_lang',App::getLocale());
        $queryJob->where('mapping_langs.module','job-postings');
        $queryJob->where('job_postings.status',1);
        $queryJob->whereIn('job_postings.id',$allIdJobpostingId);
        $queryJob->orderBy('job_postings.datetime','DESC');
        $queryJob->orderBy('job_postings.sort_order','ASC');
        $queryJob->select('job_postings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryJob = $queryJob->get()->toArray();
        if(count($queryJob) <= 0){
            $queryJob = $this->jobPostingRepository->leftJoin('mapping_langs', 'job_postings.id', '=', 'mapping_langs.master_id');
            $queryJob->where('mapping_langs.code_lang','th');
            $queryJob->where('mapping_langs.module','job-postings');
            $queryJob->where('job_postings.status',1);
            $queryJob->whereIn('job_postings.id',$allIdJobpostingId);
            $queryJob->orderBy('job_postings.datetime','DESC');
            $queryJob->orderBy('job_postings.sort_order','ASC');
            $queryJob->select('job_postings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryJob = $queryJob->get()->toArray();
        }
        return $queryJob;
    }

    public function deleteFileDownload($data,$id) {
       return $this->jobPostingRepository->where('id',$id)
       ->update([
           $data => null
       ]);
    }
}
