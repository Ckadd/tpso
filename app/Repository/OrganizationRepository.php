<?php

namespace App\Repository;

use App\Model\Organization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
class OrganizationRepository
{
    protected $organizationModel;

    public function __construct(Organization $organizationModel)
    {
        $this->organizationModel = $organizationModel;
    }

    /**
     * Find user in organization.
     *
     * @param mixed $id
     *
     * @return array
     */
    public function findUserInOrganization($id)
    {
        try {
            return $this->organizationModel->where('id', $id)
                ->with('users')
                ->firstOrFail()
                ->toArray();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function listIdRelationDepartment(int $id) { 
        
        /*return $this->organizationModel->where('department_id',$id)
        ->get()->toArray();*/
        
        $data =  $this->organizationModel->leftJoin('mapping_langs', 'organizations.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','organizations')
            ->where('organizations.department_id',$id)
            ->select('organizations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->get()->toArray();
           
        if(count($data) <= 0){
            $data =  $this->organizationModel->leftJoin('mapping_langs', 'organizations.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang','th')
                ->where('mapping_langs.module','organizations')
                ->where('organizations.department_id',$id)
                ->select('organizations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->get()->toArray();
        }
        return $data;
    }

    public function listIdDot() {
        return $this->organizationModel->where('name','กรมการท่องเที่ยว')->get()->toArray();
    }

    public function OrganizationIntranet() {
        
        try {
            return $this->organizationModel::where('name','intranet')->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function allOrganizationId() {
        return $this->organizationModel::select('id','name')->get()->toArray();
    }
}
