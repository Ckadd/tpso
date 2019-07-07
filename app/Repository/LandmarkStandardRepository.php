<?php

namespace App\Repository;
use App\Model\LandmarkStandard;

class LandmarkStandardRepository {
    
    protected $landmarkStandardRepository;

    public function __construct(LandmarkStandard $landmarkStandardRepository) {
        $this->landmarkStandardRepository = $landmarkStandardRepository;
    }

    public function getAll() {
        $data = $this->knowledgebaseRepository::leftJoin('mapping_langs', 'landmark_standards.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'landmark-standards')
            ->where('landmark_standards.status','=',1)
            ->orderBy('landmark_standards.sort_order','ASC')
            ->get()
            ->toArray();
        if(count($data) <= 0){
            $data = $this->knowledgebaseRepository::leftJoin('mapping_langs', 'landmark_standards.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'landmark-standards')
                ->where('landmark_standards.status','=',1)
                ->orderBy('landmark_standards.sort_order','ASC')
                ->get()
                ->toArray();
        }
        return $data;
    }

    public function getDataById(int $id) {
        $queryData = $this->landmarkStandardRepository->leftJoin('mapping_langs', 'landmark_standards.id', '=', 'mapping_langs.master_id');
        $queryData->where('landmark_standards.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','landmark-standards');
        $queryData->select('landmark_standards.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('landmark_standards', 'mapping_langs.master_id', '=', 'landmark_standards.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','landmark-standards')
                ->select('landmark_standards.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('landmark_standards', 'mapping_langs.master_id', '=', 'landmark_standards.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','landmark-standards')
                    ->select('landmark_standards.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('landmark_standards', 'mapping_langs.master_id', '=', 'landmark_standards.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','landmark-standards')
                    ->select('landmark_standards.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }

        if(count($queryData) <= 0){
            $queryData = $this->landmarkStandardRepository->leftJoin('mapping_langs', 'landmark_standards.id', '=', 'mapping_langs.master_id');
            $queryData->where('landmark_standards.id',$id);
            $queryData->where('mapping_langs.code_lang','');
            $queryData->where('mapping_langs.module','landmark-standards');
            $queryData->select('landmark_standards.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first()->toArray();
        }
        return $queryData;
    }

}
