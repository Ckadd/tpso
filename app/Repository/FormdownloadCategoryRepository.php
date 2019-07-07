<?php

namespace App\Repository;
use App\Model\FormDownloadCategory;

class FormdownloadCategoryRepository {
    protected $formdownloadCategoryModel;

    public function __construct(FormDownloadCategory $formdownloadCategoryModel) {
        $this->formdownloadCategoryModel = $formdownloadCategoryModel;
    }

    public function checkStatus(int $id) {
        
        return $this->formdownloadCategoryModel->where([
            'id' => $id,
            'status' => 1
        ])->get()->toArray();
    }
}