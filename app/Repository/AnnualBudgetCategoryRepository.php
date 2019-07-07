<?php

namespace App\Repository;

use App\model\AnnualBudgetCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnnualBudgetCategoryRepository { 

    protected $annualBudgetCategoryRepository;

    public function __construct(AnnualBudgetCategory $annualBudgetCategoryRepository) { 
        $this->annualBudgetCategoryRepository = $annualBudgetCategoryRepository;
    }

    public function findAllData() { 
        return $this->annualBudgetCategoryRepository::with('annualBudget')
        ->orderBy('sort_order','ASC')->get()->toArray();
    }

    public function listDataById($id) {
        try{
            return $this->annualBudgetRepository->select('annual_file')
            ->where('id',$id)->get()->toArray();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}