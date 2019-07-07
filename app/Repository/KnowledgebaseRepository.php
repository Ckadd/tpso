<?php 

namespace App\Repository;
use App\Model\Knowledgebase;
use App;
class KnowledgebaseRepository { 
    
    protected $knowledgebaseRepository;

    public function __construct(Knowledgebase $knowledgebaseRepository) {
        $this->knowledgebaseRepository = $knowledgebaseRepository;
    }

    public function getAll() {
        $data = $this->knowledgebaseRepository::leftJoin('mapping_langs', 'knowledgebases.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'knowledgebases')
            ->where('knowledgebases.status','=',1)
            ->orderBy('knowledgebases.sort_order','ASC')
            ->get()->toArray();
        if(count($data) <= 0){
            $data = $this->knowledgebaseRepository::leftJoin('mapping_langs', 'knowledgebases.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'knowledgebases')
                ->where('knowledgebases.status','=',1)
                ->orderBy('knowledgebases.sort_order','ASC')
                ->get()->toArray();
        }
            return $data;
    }

    public function getDataById(int $id) {
        $queryData = $this->knowledgebaseRepository->leftJoin('mapping_langs', 'knowledgebases.id', '=', 'mapping_langs.master_id');
        $queryData->where('knowledgebases.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','knowledgebases');
        $queryData->select('knowledgebases.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('knowledgebases', 'mapping_langs.master_id', '=', 'knowledgebases.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','knowledgebases')
                ->select('knowledgebases.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('knowledgebases', 'mapping_langs.master_id', '=', 'knowledgebases.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','knowledgebases')
                    ->select('knowledgebases.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('knowledgebases', 'mapping_langs.master_id', '=', 'knowledgebases.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','knowledgebases')
                    ->select('knowledgebases.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }
        if(count($queryData) <= 0){
            $queryData = $this->knowledgebaseRepository->leftJoin('mapping_langs', 'knowledgebases.id', '=', 'mapping_langs.master_id');
            $queryData->where('knowledgebases.id',$id);
            $queryData->where('mapping_langs.code_lang','');
            $queryData->where('mapping_langs.module','knowledgebases');
            $queryData->select('knowledgebases.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first()->toArray();
        }
        return $queryData;
    }
}
