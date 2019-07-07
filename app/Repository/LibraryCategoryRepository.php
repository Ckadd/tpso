<?php
namespace App\Repository;

use App\Model\CategoryLibraryBook;

class LibraryCategoryRepository {

    protected $libraryCategoryModel;

    public function __construct(
        CategoryLibraryBook $libraryCategoryModel
    ) 
    {
        $this->libraryCategoryModel = $libraryCategoryModel;
    }

    public function getData() {
        
        return $this->libraryCategoryModel::where('status',1)
            ->orderBy('order','ASC')
            ->orderBy('created_at','DESC')
            ->get()->toArray();
    }
}