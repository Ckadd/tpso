<?php

namespace App\Repository;

use App\Model\FaqCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqCategoryRepository
{
    protected $faqCategoryModel;

    public function __construct(FaqCategory $faqCategoryModel)
    {
        $this->faqCategoryModel = $faqCategoryModel;
    }

    /**
     * list data all relation from faqs.
     *
     * @param mixed $id
     *
     * @return array
     */
    public function findFaqInFaqcategory($id)
    {
        try {
            return $this->faqCategoryModel->where('id', $id)
                ->with('faqs')
                ->firstOrFail()
                ->toArray();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function listdata() { 
        try {
            $dataCategory = $this->faqCategoryModel->where('status',1)
            ->orderBy('id','asc')
            ->get()->toArray();
            
            $idCategory = [];
            foreach($dataCategory as $Key => $value) {
                $idCategory[] = $value['id'];
            }

            return $idCategory;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listCategory() {
        return  $this->faqCategoryModel->where('status',1)
        ->orderBy('id','asc')
        ->get()->toArray();
    }

    public function listCategoryByName(int $id) {
        $data = $this->faqCategoryModel->where('status',1)
        ->where('id',$id)->get()->toArray();
        $idArray = [];

        foreach($data as $key => $val) {
            $idArray[] = $val['id'];
        }

        return $idArray;
    }
}
