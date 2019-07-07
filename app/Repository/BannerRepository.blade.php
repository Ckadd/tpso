<?php

namespace App\Repository;

use App\Model\Banner;
use App\Repository\OrganizationRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;

class BannerRepository
{
    protected $bannerRepository;
    protected $organizationRepository;

    public function __construct(Banner $bannerRepository,OrganizationRepository $organizationRepository)
    {
        $this->bannerRepository = $bannerRepository;
        $this->organizationRepository = $organizationRepository;
    }

    public function listdata() { 
        try {
            $idDot = $this->organizationRepository->listIdDot();
            
            if(!empty($idDot)) {

                $id = $idDot[0]['id'];

                $dataBanner['departmentIn'] = $this->listBannerDot($id,1);
                $dataBanner['departmentOut'] = $this->listBannerDot($id,2);
                $dataBanner['departmentEtc'] = $this->listBannerDot($id,3);
                $dataBanner['bannerDot'] = $this->listBannerDot($id,4);
                
                return $dataBanner;
            }else {
                return [];
            }

        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listdataIntranet(int $intranetId)
    {
        $dataBanner['menuTop'] = $this->listBannerDot($intranetId,5);
        $dataBanner['menuLeft'] = $this->listBannerDot($intranetId,6);
        $dataBanner['bottom'] = $this->listBannerDot($intranetId,7);

        return $dataBanner;
    }

    public function listDataByOrganizationId(int $id) {

        $departmentIn = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','banners')
            ->where('banners.status',1)
            ->where('banners.type',1)
            ->where('banners.organization_id',$id)
            ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('banners.sort_order','ASC')
            ->take(3)
            ->get()->toArray();

        if(count($departmentIn) <= 0){
            $departmentIn = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','banners')
                ->where('banners.status',1)
                ->where('banners.type',1)
                ->where('banners.organization_id',$id)
                ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('banners.sort_order','ASC')
                ->take(3)
                ->get()->toArray();
        }
        $dataBanner[''] = $departmentIn;

        $departmentOut = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','banners')
            ->where('banners.status',1)
            ->where('banners.type',2)
            ->where('banners.organization_id',$id)
            ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('banners.sort_order','ASC')
            ->take(4)
            ->get()->toArray();
        if(count($departmentOut) <= 0){
            $departmentOut = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang','th')
                ->where('mapping_langs.module','banners')
                ->where('banners.status',1)
                ->where('banners.type',2)
                ->where('banners.organization_id',$id)
                ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('banners.sort_order','ASC')
                ->take(4)
                ->get()->toArray();
        }
        $dataBanner['departmentOut'] = $departmentOut;

        return $dataBanner;
    }

    public function listBannerDot(int $id,int $type)
    {
        if($type == 7) {
            $querydata = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','banners')
            ->where('banners.status',1)
            ->where('banners.type',$type)
            ->where('banners.organization_id',$id)
            ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('banners.sort_order','ASC')
            ->take(5)
            ->get()->toArray();
            
            if(count($querydata) <= 0){
                $querydata = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','banners')
                    ->where('banners.status',1)
                    ->where('banners.type',$type)
                    ->where('banners.organization_id',$id)
                    ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('banners.sort_order','ASC')
                    ->take(5)
                    ->get()->toArray();
            }
            $data = $this->getDateTime($querydata);
        }else {
            $querydata = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','banners')
            ->where('banners.status',1)
            ->where('banners.type',$type)
            ->where('banners.organization_id',$id)
            ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('banners.sort_order','ASC')
            ->get()->toArray();

            if(count($querydata) <= 0){
                $querydata = $this->bannerRepository->leftJoin('mapping_langs', 'banners.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','banners')
                    ->where('banners.status',1)
                    ->where('banners.type',$type)
                    ->where('banners.organization_id',$id)
                    ->select('banners.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('banners.sort_order','ASC')
                    ->get()->toArray();
            }
            $data = $this->getDateTime($querydata);
        }
        return $data;
    }

    public function getDateTime(array $data) {
        $allData = [];
        foreach($data as $keyData => $valueData) {
            if($valueData['start_date'] == null && $valueData['end_date'] == null) {
                $allData[] = $valueData;
            }else if($valueData['start_date'] != null || $valueData['end_date'] != null) {
                if(($valueData['start_date'] < date('Y-m-d') || $valueData['start_date'] = date('Y-m-d')) && $valueData['end_date'] >= date('Y-m-d')) {
                    $allData[] = $valueData;
                }
            }
        }

        return $allData;
    }

    public function listUrlById(int $id) {
        try {

            return $this->bannerRepository->findOrFail($id);
        }catch(ModelNotFoundException $e) {
            return [];
        }
        
    }
}
