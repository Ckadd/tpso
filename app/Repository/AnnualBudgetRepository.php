<?php

namespace App\Repository;

use App\model\AnnualBudget;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
class AnnualBudgetRepository { 

    protected $annualBudgetRepository;

    public function __construct(AnnualBudget $annualBudgetRepository) { 
        $this->annualBudgetRepository = $annualBudgetRepository;
    }

    public function findAllData(int $id) { 
        $arrData =  $this->annualBudgetRepository->leftJoin('mapping_langs', 'annual_budgets.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'annual-budgets')
            ->where('annual_budgets.status', 1)
            ->where('annual_budgets.annual_category_id', $id)
            ->select('annual_budgets.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->with('annualBudgetCategory')
            ->orderBy('annual_budgets.sort_order', 'ASC')->get()->toArray();
        if(count($arrData) <= 0){
            $arrData =  $this->annualBudgetRepository->leftJoin('mapping_langs', 'annual_budgets.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'annual-budgets')
                ->where('annual_budgets.status', 1)
                ->where('annual_budgets.annual_category_id', $id)
                ->select('annual_budgets.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->with('annualBudgetCategory')
                ->orderBy('annual_budgets.sort_order', 'ASC')->get()->toArray();
        }
        return $arrData;
    }

    public function listDataById($id) {
        try{
            return $this->annualBudgetRepository->select('annual_file')
            ->where('id',$id)->get()->toArray();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function deleteFileDownload($data,$id){
        return $this->annualBudgetRepository->where('id',$id)->update([
            $data => null
        ]);
    }
}
