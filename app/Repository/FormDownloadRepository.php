<?php

namespace App\Repository;

use App\model\FormDownload;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
class FormDownloadRepository { 

    protected $formDownloadRepository;

    public function __construct(FormDownload $formDownloadRepository) { 
        $this->formDownloadRepository = $formDownloadRepository;
    }

    public function findAllData(int $organizationId) { 
        $data =  $this->formDownloadRepository->leftJoin('mapping_langs', 'form_downloads.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'form-downloads')
            ->where('form_downloads.status',1)
            ->where('organization_id',$organizationId)
            ->select('form_downloads.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('form_downloads.sort_order','ASC')
            ->get()
            ->toArray();
        if(count($data) <= 0) {
            $data = $this->formDownloadRepository->leftJoin('mapping_langs', 'form_downloads.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'form-downloads')
                ->where('form_downloads.status', 1)
                ->select('form_downloads.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->orderBy('form_downloads.sort_order', 'ASC')
                ->get()
                ->toArray();
        }

        return $data;
    }

    public function listDataById($id) {
        try{
            return $this->formDownloadRepository->select('file')
            ->where('id',$id)->get()->toArray();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listDataByDepartmentId(int $id) {
        return $this->formDownloadRepository->where('status',1)
            ->where('organization_id',$id)
            ->orderBy('datetime','DESC')
            ->orderBy('sort_order','ASC')
            ->get()->toArray();
    }

    public function listCategoryDepartmentId(int $id,int $idCategory) {
        return $this->formDownloadRepository->where('status',1)
            ->where('organization_id',$id)
            ->where('category_id',$idCategory)
            ->orderBy('datetime','DESC')
            ->orderBy('sort_order','ASC')
            ->get()->toArray();
    }

    public function listDetailDataById($id) {
        try{
            return $this->queryByIdDetail($id);
        }catch(ModelNotFoundException $e) {

            return [];
        }
    }

    public function deleteFileDownload($data,$id) {
        
        foreach($data as $value_file) {
            
            $this->formDownloadRepository->where('id',$id)
            ->update([
                $value_file => null
            ]);
        }
       return;
    }

    private function queryByIdDetail($id){

        $queryData = $this->formDownloadRepository->leftJoin('mapping_langs', 'form_downloads.id', '=', 'mapping_langs.master_id');
        $queryData->where('form_downloads.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','form-downloads');
        $queryData->select('form_downloads.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->get();
        if(count($queryData) > 0){
            $queryData = $queryData->toArray();
        }else{

            $queryData = MappingLang::join('form_downloads', 'mapping_langs.master_id', '=', 'form_downloads.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','form-downloads')
                ->select('form_downloads.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->get();
            if(count($queryData) > 0) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('form_downloads', 'mapping_langs.master_id', '=', 'form_downloads.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','form-downloads')
                    ->select('form_downloads.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('form_downloads', 'mapping_langs.master_id', '=', 'form_downloads.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','form-downloads')
                    ->select('form_downloads.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->get();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }

        if(count($queryData) <= 0){
            $queryData = $this->formDownloadRepository->leftJoin('mapping_langs', 'form_downloads.id', '=', 'mapping_langs.master_id');
            $queryData->where('form_downloads.id',$id);
            $queryData->where('mapping_langs.code_lang','th');
            $queryData->where('mapping_langs.module','form-downloads');
            $queryData->select('form_downloads.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->get()->toArray();
        }
        return $queryData;
    }
}
