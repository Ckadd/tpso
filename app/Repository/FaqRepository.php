<?php

namespace App\Repository;

use App\Model\Faq;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
class FaqRepository
{
    protected $faqRepository;

    public function __construct(Faq $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function listdata(array $id) { 
        try {
            $alldata = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'faqs')
                ->where('faqs.status',1)
                ->whereIn('faqs.faq_category_id',$id)
                ->where('faqs.is_featured',0)
                ->select('faqs.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('faqs.order','ASC')
                ->get()
                ->toArray();
            //df lang
            if(count($alldata) <= 0){
                $alldata = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'faqs')
                    ->where('faqs.status',1)
                    ->whereIn('faqs.faq_category_id',$id)
                    ->where('faqs.is_featured',0)
                    ->select('faqs.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('faqs.order','ASC')
                    ->get()
                    ->toArray();
            }

            $feature = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'faqs')
                ->where('faqs.status',1)
                ->whereIn('faqs.faq_category_id',$id)
                ->where('faqs.is_featured',1)
                ->select('faqs.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('faqs.order','ASC')
                ->get()
                ->toArray();
            //df lang
            if(count($feature) <= 0){
                $feature = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'faqs')
                    ->where('faqs.status',1)
                    ->whereIn('faqs.faq_category_id',$id)
                    ->where('faqs.is_featured',1)
                    ->select('faqs.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('faqs.order','ASC')
                    ->get()
                    ->toArray();
            }

            if(!empty($alldata) || !empty($feature)) {
                $a[] = $alldata; $f[] = $feature;
                $data['dataFaqs'] = $a;
                $data['feature'] = $f;
                return $data;
            }else{ 
                return [];
            }

            
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listDataById(int $id) {
        return $this->faqRepository::find($id)->toArray();
    }

    public function listDataByIdCategory(array $id,array $idAllCategory) {
            $alldata = [];
            $feature = [];
            foreach($id as $keyIdCategory => $valueIdCategory) {
                $alldata[] = $this->faqRepository->where('status',1)
                ->where('faq_category_id',$valueIdCategory)
                ->where('is_featured',0)
                ->orderBy('order','ASC')
                ->get()->toArray();
            }

            foreach($idAllCategory as $keyIdCategory => $valueIdCategory) {
                $feature[] = $this->faqRepository->where('status',1)
                ->where('faq_category_id',$valueIdCategory)
                ->where('is_featured',1)
                ->orderBy('order','ASC')
                ->get()->toArray();
                
            }

            $data['dataFaqs'] = $alldata;
            $data['feature'] = $feature;
            return $data;
    }

    public function listDataByIdCategoryAndKeyword(array $id,array $idAllCategory,string $keyword) {
        $alldata = [];
        $feature = [];
        
        foreach($id as $keyIdCategory => $valueIdCategory) {
            $alldata[] = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'faqs')
                ->where('faqs.status',1)
                ->where('faqs.faq_category_id',$valueIdCategory)
                ->where('faqs.is_featured',0)
                ->where('faqs.title','like','%'.$keyword.'%')
                ->orderBy('faqs.order','ASC')
                ->get()->toArray();
        }

        foreach($idAllCategory as $keyIdCategory => $valueIdCategory) {
            $feature[] = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'faqs')
                ->where('faqs.status',1)
                ->where('faqs.faq_category_id',$valueIdCategory)
                ->where('faqs.is_featured',1)
                ->orderBy('faqs.order','ASC')
                ->get()->toArray();
        }

        $data['dataFaqs'] = $alldata;
        $data['feature'] = $feature;
        
        return $data;
    }

    public function listdataByKeyword(array $id,string $keyword) { 
        try {
            
            $alldata = [];
            $feature = [];
            foreach($id as $keyIdCategory => $valueIdCategory) {
                $res_alldata = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', App::getLocale())
                    ->where('mapping_langs.module', 'faqs')
                    ->where('faqs.status',1)
                    ->where('faqs.faq_category_id',$valueIdCategory)
                    ->where('faqs.is_featured',0)
                    ->where('faqs.title','like','%'.$keyword.'%')
                    ->orderBy('faqs.order','ASC')
                    ->get()->toArray();

                if(count($res_alldata) <= 0){
                    $alldata[] = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                        ->where('mapping_langs.code_lang', 'th')
                        ->where('mapping_langs.module', 'faqs')
                        ->where('faqs.status',1)
                        ->where('faqs.faq_category_id',$valueIdCategory)
                        ->where('faqs.is_featured',0)
                        ->where('faqs.title','like','%'.$keyword.'%')
                        ->orderBy('faqs.order','ASC')
                        ->get()->toArray();
                }else{
                    $alldata[] = $res_alldata;
                }

                 $res_feature = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', App::getLocale())
                    ->where('mapping_langs.module', 'faqs')
                    ->where('faqs.status',1)
                    ->where('faqs.faq_category_id',$valueIdCategory)
                    ->where('faqs.is_featured',1)
                    ->orderBy('faqs.order','ASC')
                    ->get()
                    ->toArray();
                if(count($res_feature) <= 0){
                    $feature[] = $this->faqRepository->leftJoin('mapping_langs', 'faqs.id', '=', 'mapping_langs.master_id')
                        ->where('mapping_langs.code_lang', 'th')
                        ->where('mapping_langs.module', 'faqs')
                        ->where('faqs.status',1)
                        ->where('faqs.faq_category_id',$valueIdCategory)
                        ->where('faqs.is_featured',1)
                        ->orderBy('faqs.order','ASC')
                        ->get()
                        ->toArray();
                }else{
                    $feature[] = $res_feature;
                }
                
            }

            if(!empty($alldata) || !empty($feature)) {
                $data['dataFaqs'] = $alldata;
                $data['feature'] = $feature;

                return $data;
            }else{ 
                return [];
            }

            
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}
