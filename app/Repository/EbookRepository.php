<?php

namespace App\Repository;

use App\model\Ebook;
use App\Model\EbookCategory;
use App\Model\Organization;
use App\Model\EbookOrganization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
class EbookRepository { 

    protected $annualBudgetRepository;
    protected $ebookCategoryRepository;
    protected $ebookRepository;
    protected $organizationModel;
    protected $ebookOrganizationModel;

    public function __construct(
        EbookCategory $ebookCategoryRepository,
        Ebook $ebookRepository,
        Organization $organizationModel,
        EbookOrganization $ebookOrganizationModel
        ) { 

        $this->ebookCategoryRepository = $ebookCategoryRepository;
        $this->ebookRepository = $ebookRepository;
        $this->organizationModel = $organizationModel;
        $this->ebookOrganizationModel = $ebookOrganizationModel;
    }

    public function listDataFirst() {
        try{

            $ebookCategory = $this->ebookCategoryRepository->select('*')
            ->where('status',1)->with('ebook')->get()->toArray();

            return $ebookCategory[0]['ebook'][0];
        }catch(ModelNotFoundException $e) {

            return [];
        }
    }

    public function listDataCategory() {
            $quertCategory = $this->ebookCategoryRepository->select('*')
            ->where('status',1)->orderBy('sort_order','ASC')->get()->toArray();
            $ebookCategory = array_chunk($quertCategory,2);
            
            return $ebookCategory;
    }

    public function listGroup(int $id) {
        // list organization = dot
        $checkOrganizationId = $this->organizationModel->select('id')->where('name','กรมการท่องเที่ยว')->get()->toArray();
        
        if(!empty($checkOrganizationId)) {
            $organizationId = $checkOrganizationId[0]['id'];

            return $this->getDataEbookByOrganization($organizationId,$id);
            
        }
        return [];
    }  
    
    public function listDataView(int $id) {
        try{
            $queryData = $this->ebookRepository->leftJoin('mapping_langs', 'ebooks.id', '=', 'mapping_langs.master_id');
            $queryData->where('mapping_langs.code_lang',App::getLocale());
            $queryData->where('mapping_langs.module','ebooks');
            $queryData->where('ebooks.id',$id);
            $queryData->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->get();
            if(isset($queryData)){
                $queryData = $queryData->toArray();
            }else{
                $queryData = MappingLang::join('ebooks', 'mapping_langs.master_id', '=', 'ebooks.id')
                    ->where('mapping_langs.parent_id',$id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','ebooks')
                    ->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->get();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }else{
                    $f_queryData = MappingLang::join('ebooks', 'mapping_langs.master_id', '=', 'ebooks.id')
                        ->where('mapping_langs.master_id',$id)
                        //->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','ebooks')
                        ->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->first();
                    $queryData = MappingLang::join('ebooks', 'mapping_langs.master_id', '=', 'ebooks.id')
                        ->where('mapping_langs.master_id',$f_queryData->parent_id)
                        ->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','ebooks')
                        ->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->get();
                    if(isset($queryData)) {
                        $queryData = $queryData->toArray();
                    }
                }
            }

            //
            if(count($queryData) <= 0){
                $queryData = $this->ebookRepository->leftJoin('mapping_langs', 'ebooks.id', '=', 'mapping_langs.master_id');
                $queryData->where('mapping_langs.code_lang','th');
                $queryData->where('mapping_langs.module','ebooks');
                $queryData->where('ebooks.id',$id);
                $queryData->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                $queryData = $queryData->get()->toArray();
            }
            
            $ebookView =  $queryData;

            $data['ebookView'] = $ebookView[0];
            $data['idReturnBack'] = $ebookView[0]['category_id'];

            return $data;
        }catch(ModelNotFoundException $e) {

            return [];
        }
    }

    public function listDepartment(int $idDepartment,int $idCategory) {
        
        // list organization by departmentId
        $checkOrganizationId = $this->organizationModel->select('id')->where('department_id',$idDepartment)->get()->toArray();
        
        if(!empty($checkOrganizationId)) {
            $organizationId = $checkOrganizationId[0]['id'];
            
            return $this->getDataEbookByOrganization($organizationId,$idCategory);
        }
    }

    /**
     * get ebook by organization
     *
     * @param integer $organizationId
     * @param integer $categoryId
     * @return void
     */
    private function getDataEbookByOrganization(int $organizationId,int $categoryId) {
        // list [id] ebook from table ebook_organization (many-to-many)
        $listEbook = $this->ebookOrganizationModel::select('ebook_id')
        ->where('organization_id',$organizationId)->get()->toArray();
        $ebookId = (!empty($listEbook))? array_column($listEbook,'ebook_id') : [];
        
        if(!empty($ebookId)) {
            $quertlistGroup = $this->ebookRepository->leftJoin('mapping_langs', 'ebooks.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'ebooks')
            ->where('ebooks.status',1)
            ->where('ebooks.category_id',$categoryId)
            ->whereIn('ebooks.id',$ebookId)
            ->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('ebooks.sort_order','ASC')
            ->orderBy('datetime','DESC')
            ->get()
            ->toArray();
            
            if(count($quertlistGroup) <= 0){
                $quertlistGroup = $this->ebookRepository->leftJoin('mapping_langs', 'ebooks.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'ebooks')
                    ->where('ebooks.status',1)
                    ->where('ebooks.category_id',$categoryId)
                    ->whereIn('ebooks.id',$ebookId)
                    ->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('ebooks.sort_order','ASC')
                    ->orderBy('datetime','DESC')
                    ->get()
                    ->toArray();
            }
            $ebooklistGroup = array_chunk($quertlistGroup,2);
           
            return $ebooklistGroup;
        }
        return [];
    }

    public function listDataByOrganization(int $idDepartment) {

        // list organization by departmentId
        $checkOrganizationId = $this->organizationModel->select('id')->where('department_id',$idDepartment)->get()->toArray();
        
        if(!empty($checkOrganizationId)) {
            $organizationId = $checkOrganizationId[0]['id'];

             // list [id] ebook from table ebook_organization (many-to-many)
            $listEbook = $this->ebookOrganizationModel::select('ebook_id')
                ->where('organization_id',$organizationId)
                ->get()
                ->toArray();

            $ebookId = (!empty($listEbook))? array_column($listEbook,'ebook_id') : [];
            
            if(!empty($ebookId)) {
                $quertlistGroup = $this->ebookRepository->leftJoin('mapping_langs', 'ebooks.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'ebooks')
                ->where('ebooks.status',1)
                ->whereIn('ebooks.id',$ebookId)
                ->select('ebooks.category_id', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('ebooks.sort_order','ASC')
                ->orderBy('datetime','DESC')
                ->get()
                ->toArray();

                $listIdBycolumnCategory = array_column($quertlistGroup,'category_id');
                $categoryId = array_unique($listIdBycolumnCategory);
                $dataCategory = $this->ebookCategoryRepository->whereIn('id',$categoryId)->get()->toArray();
                
                if(count($quertlistGroup) <= 0){
                    $quertlistGroup = $this->ebookRepository->leftJoin('mapping_langs', 'ebooks.id', '=', 'mapping_langs.master_id')
                        ->where('mapping_langs.code_lang', 'th')
                        ->where('mapping_langs.module', 'ebooks')
                        ->where('ebooks.status',1)
                        ->whereIn('ebooks.id',$ebookId)
                        ->select('ebooks.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->orderBy('ebooks.sort_order','ASC')
                        ->orderBy('datetime','DESC')
                        ->get()
                        ->toArray();

                    $listIdBycolumnCategory = array_column($quertlistGroup,'category_id');
                    $categoryId = array_unique($listIdBycolumnCategory);
                    $dataCategory = $this->ebookCategoryRepository->whereIn('id',$categoryId)->get()->toArray();
                }
                $ebooklistGroup = array_chunk($dataCategory,2);
               
                return $ebooklistGroup;
            }
        }
        return [];
    }

    public function deleteFileDownload($data,$id) {
        
        return $this->ebookRepository->where('id',$id)
                ->update([
                    $data => null
                ]);
    }
}
