<?php

namespace App\Repository;

use App\model\Library;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LibraryRepository { 

    protected $libraryRepository;

    public function __construct(Library $libraryRepository) { 
        $this->libraryRepository = $libraryRepository;
    }

    public function findAllData() { 
        $data = $this->libraryRepository->where('status',1)
        ->orderBy('sort_order','ASC')->get()->toArray();
        $newdata=[];
        foreach(array_chunk($data,2) as $key => $val) {
            $newdata['library'][$key] = $val;
        }
        return $newdata;
    }

    public function findDataById($id) { 
        try{
            return $this->libraryRepository::find($id)->toArray();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}