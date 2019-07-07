<?php

namespace App\Repository;

use App\Model\Page;
use App\Model\PageOrganization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
class PageRepository
{
    protected $pageRepository;
    protected $pageOrganizationRepository;

    public function __construct(Page $pageRepository,PageOrganization $pageOrganizationRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->pageOrganizationRepository = $pageOrganizationRepository;
    }

    public function listDataById(int $id) { 
        try {
            $dataPage = $this->pageRepository::leftJoin('mapping_langs', 'pages.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','pages')
                ->where('pages.id',$id)
                ->where('pages.status','ACTIVE')
                ->select('pages.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->get()->toArray();;
            if(!empty($dataPage)) {
                return  $dataPage[0];
            }else {
                $queryData = MappingLang::join('pages', 'mapping_langs.master_id', '=', 'pages.id')
                    ->where('mapping_langs.parent_id',$id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','pages')
                    ->select('pages.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->get()->toArray();
                if(!empty($queryData)) {
                    return  $queryData[0];
                }else{
                    $f_queryData = MappingLang::join('pages', 'mapping_langs.master_id', '=', 'pages.id')
                        ->where('mapping_langs.master_id',$id)
                        //->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','pages')
                        ->select('pages.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->first();
                    $queryData = MappingLang::join('pages', 'mapping_langs.master_id', '=', 'pages.id')
                        ->where('mapping_langs.master_id',$f_queryData->parent_id)
                        ->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','pages')
                        ->select('pages.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->get()->toArray();
                    if(!empty($queryData)) {
                        return  $queryData[0];
                    }

                    $dataPage = $this->pageRepository::leftJoin('mapping_langs', 'pages.id', '=', 'mapping_langs.master_id')
                        ->where('mapping_langs.code_lang','th')
                        ->where('mapping_langs.module','pages')
                        ->where('pages.id',$id)
                        ->where('pages.status','ACTIVE')
                        ->select('pages.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->get()
                        ->toArray();
                    if(empty($dataPage)) {
                        return $dataPage;
                    }

                    return $dataPage[0];
                }
                
            }
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listPageThankYou() {
        return $this->pageRepository->select('id')
        ->where('slug','thank-you-pages')
        ->where('status','ACTIVE')
        ->get()->toArray();
    }

    public function listPagesContent() {
        $namePage = [
            'งานบริการและมาตรฐานการท่องเที่ยว',
            'งานทะเบียนธุรกิจนำเที่ยวและมัคคุเทศก์',
            'งานพัฒนาแหล่งท่องเที่ยว',
            'งานกิจการภาพยนต์และวิดีทัศน์ต่างประเทศ',
            'งานมาตรฐานบุคลากรด้านการท่องเที่ยว'
        ];
        
        $contentPages = [];
        foreach($namePage as $keyname => $valname) {
            
            $contentPages[$namePage[$keyname]] = $this->pageRepository->where('slug',$valname)
            ->where('status','ACTIVE')->orderBy('id','DESC')->take(1)->get()->toArray();
            
        }
        return $contentPages;
    }

    public function listPagesByOrganizationId(int $id) {
        
        $pageOrganization = $this->pageOrganizationRepository->where('organization_id',$id)
        ->get()->toArray();
        
        if(!empty($pageOrganization)) {
            $pageId = $pageOrganization[0]['page_id'];
            $dataPage = $this->pageRepository->where('id',$pageId)
            ->where('status','ACTIVE')
            ->take(7)
            ->get()
            ->toArray();
            
            return $dataPage;
        }

        return [];
    }

    public function thankYouPageMail() {

        return $this->pageRepository->select('*')
        ->where('slug','thank-you-mail')
        ->where('status','ACTIVE')
        ->get()->toArray();
    }

    public function listIntroPage() {
        return $this->pageRepository::where('slug','intro-pages')
        ->where('status','ACTIVE')->get()->toArray();
    }
}
