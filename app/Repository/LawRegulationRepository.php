<?php

namespace App\Repository;

use App\model\LawsRegulation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LawRegulationRepository { 

    protected $lawRegulationRepository;

    public function __construct(LawsRegulation $lawRegulationRepository) { 
        $this->lawRegulationRepository = $lawRegulationRepository;
    }

    public function listDataLawTravel() { 
        $data = $this->lawRegulationRepository->with('lawsRegulationCategory')->get()->toArray();
        dd($data[0]);
    }
    public function downloadFileByCategoryId(int $id,string $type) {
        return $this->lawRegulationRepository::find($id)->toArray();
    }

    public function findDataById(int $id) {
        $queryData = $this->lawRegulationRepository->leftJoin('mapping_langs', 'laws_regulations.id', '=', 'mapping_langs.master_id');
        $queryData->where('laws_regulations.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','laws-regulations');
        $queryData->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('laws_regulations', 'mapping_langs.master_id', '=', 'laws_regulations.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','laws-regulations')
                ->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('laws_regulations', 'mapping_langs.master_id', '=', 'laws_regulations.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','laws-regulations')
                    ->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('laws_regulations', 'mapping_langs.master_id', '=', 'laws_regulations.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','laws-regulations')
                    ->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }
        if(empty($queryData)){
            $queryData = $this->lawRegulationRepository->leftJoin('mapping_langs', 'laws_regulations.id', '=', 'mapping_langs.master_id');
            $queryData->where('laws_regulations.id',$id);
            $queryData->where('mapping_langs.code_lang','th');
            $queryData->where('mapping_langs.module','laws-regulations');
            $queryData->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first();
            if(isset($queryData)){
                $queryData = $queryData->toArray();
            }
        }
        return $queryData;
    }

    public function listDepartmentId(int $organizationId,int $categoryId) {

        return $this->lawRegulationRepository->where('law_category_id',$categoryId)
        ->where('organization_id',$organizationId)
        ->where('status',1)
        ->orderBy('datetime','ASC')
        ->orderBy('sort_order','ASC')
        ->get()->toArray();
    }
}
