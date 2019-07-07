<?php 

namespace App\Repository;
use App\Model\MissionStatement;
use App\Model\MappingLang;
class MissionStatementRepository { 

    protected $missionStatement;
    protected $themeService;
    public function __construct(MissionStatement $missionStatement) {
        $this->missionStatement = $missionStatement;
    }

    public function listData() {
        $queryJob = $this->missionStatement->leftJoin('mapping_langs', 'mission_statements.id', '=', 'mapping_langs.master_id');
        $queryJob->where('mapping_langs.code_lang',App::getLocale());
        $queryJob->where('mapping_langs.module','mission-statements');
        $queryJob->where('mission_statements.status',1);
        $queryJob->orderBy('mission_statements.id','DESC');
        $queryJob->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryJob = $queryJob->get()->toArray();
        if(count($queryJob) <= 0){
            $queryJob = $this->missionStatement->leftJoin('mapping_langs', 'mission_statements.id', '=', 'mapping_langs.master_id');
            $queryJob->where('mapping_langs.code_lang','th');
            $queryJob->where('mapping_langs.module','mission-statements');
            $queryJob->where('mission_statements.status',1);
            $queryJob->orderBy('mission_statements.id','DESC');
            $queryJob->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryJob = $queryJob->get()->toArray();
        }
        return $queryJob;
    }

    public function listfileById(int $id) { 
        $queryData = $this->missionStatement->leftJoin('mapping_langs', 'mission_statements.id', '=', 'mapping_langs.master_id');
        $queryData->where('mission_statements.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','mission-statements');
        $queryData->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('mission_statements', 'mapping_langs.master_id', '=', 'mission_statements.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','mission-statements')
                ->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('mission_statements', 'mapping_langs.master_id', '=', 'mission_statements.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','mission-statements')
                    ->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('mission_statements', 'mapping_langs.master_id', '=', 'mission_statements.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','mission-statements')
                    ->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }
        if(empty($queryData)){
            $queryData = $this->missionStatement->leftJoin('mapping_langs', 'mission_statements.id', '=', 'mapping_langs.master_id');
            $queryData->where('mission_statements.id',$id);
            $queryData->where('mapping_langs.code_lang','th');
            $queryData->where('mapping_langs.module','mission-statements');
            $queryData->select('mission_statements.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first();
            if(isset($queryData)){
                $queryData = $queryData->toArray();
            }
        }
        return $queryData;
        $explodecomma = explode(',',$data['image']);
        $replacepath = str_replace('\\','/',$explodecomma);
        return $replacepath;
    }

    public function deleteFileDownload($data,$id) {
       return $this->missionStatement->where('id',$id)
       ->update([
           $data => null
       ]);;
    }
}
