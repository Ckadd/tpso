<?php 

namespace App\Repository;
use App\Model\PublicGuide;

class PublicGuideRepository { 
    
    protected $publicGuideRepository;

    public function __construct(PublicGuide $publicGuideRepository) {
        $this->publicGuideRepository = $publicGuideRepository;
    }

    public function getAll() {
        /*$data = $this->publicGuideRepository::where('status','=',1)
        ->orderBy('sort_order','ASC')
        ->get()->toArray();
        return $data;*/
        $data = $this->publicGuideRepository::leftJoin('mapping_langs', 'public_guides.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'public-guides')
            ->where('public_guides.status','=',1)
            ->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('public_guides.sort_order','ASC')
            ->get()
            ->toArray();
        if(count($data) <= 0){
            $data = $this->publicGuideRepository::leftJoin('mapping_langs', 'public_guides.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'public-guides')
                ->where('public_guides.status','=',1)
                ->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('public_guides.sort_order','ASC')
                ->get()
                ->toArray();
        }
        return $data;
    }

    public function getDataById(int $id) {
        /*$data = $this->publicGuideRepository::find($id);
        return $data;*/
        $queryData = $this->publicGuideRepository->leftJoin('mapping_langs', 'public_guides.id', '=', 'mapping_langs.master_id');
        $queryData->where('public_guides.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','public-guides');
        $queryData->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('public_guides', 'mapping_langs.master_id', '=', 'public_guides.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','public-guides')
                ->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('public_guides', 'mapping_langs.master_id', '=', 'public_guides.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','public-guides')
                    ->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('public_guides', 'mapping_langs.master_id', '=', 'public_guides.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','public-guides')
                    ->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }

        if(count($queryData) <= 0){
            $queryData = $this->publicGuideRepository->leftJoin('mapping_langs', 'public_guides.id', '=', 'mapping_langs.master_id');
            $queryData->where('public_guides.id',$id);
            $queryData->where('mapping_langs.code_lang','');
            $queryData->where('mapping_langs.module','public-guides');
            $queryData->select('public_guides.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first()->toArray();
        }
        return $queryData;
    }

}
