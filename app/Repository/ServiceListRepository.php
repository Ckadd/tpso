<?php

namespace App\Repository;

use App\Model\ServiceList;
use App\Model\Organization;
use App;
use App\Model\MappingLang;

class ServiceListRepository {
    
    protected $serviceModel;
    protected $organizationModel;

    public function __construct(ServiceList $serviceModel,Organization $organizationModel)
    {
        $this->serviceModel = $serviceModel;
        $this->organizationModel = $organizationModel;
    }

    public function listServiceByOrganizationId(int $id) {
        $data = $this->serviceModel::leftJoin('mapping_langs', 'service_lists.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','service-lists')
            ->where('service_lists.organization_id',$id)
            ->where('service_lists.status',1)
            ->select('service_lists.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->take(5)
            ->orderBy('service_lists.sort_order','ASC')
            ->get()->toArray();
        if(count($data) <= 0){
            $data = $this->serviceModel::leftJoin('mapping_langs', 'service_lists.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang','th')
                ->where('mapping_langs.module','service-lists')
                ->where('service_lists.organization_id',$id)
                ->where('service_lists.status',1)
                ->select('service_lists.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->take(5)
                ->orderBy('service_lists.sort_order','ASC')
                ->get()->toArray();
        }
        return $data;
    }

    public function listService() {

        $idOrganization = $this->organizationModel::where('name','กรมการท่องเที่ยว')
            ->orderBy('id','ASC')
            ->get()
            ->toArray();
        $id = $idOrganization[0]['id'];

        if(!empty($id)){
            $data = $this->serviceModel::leftJoin('mapping_langs', 'service_lists.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','service-lists')
                ->where('service_lists.organization_id',$id)
                ->where('service_lists.status',1)
                ->select('service_lists.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->take(5)
                ->orderBy('service_lists.sort_order','ASC')
                ->get()->toArray();
            if(count($data) <= 0){
                $data = $this->serviceModel::leftJoin('mapping_langs', 'service_lists.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','service-lists')
                    ->where('service_lists.organization_id',$id)
                    ->where('service_lists.status',1)
                    ->select('service_lists.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->take(5)
                    ->orderBy('service_lists.sort_order','ASC')
                    ->get()->toArray();
            }
            return $data;
        }else {
            return [];
        }
        
    }
    
}
