<?php

namespace App\Repository;

use App\model\LawsRegulationCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App,File;
class LawRegulationCategoryRepository { 

    protected $lawsRegulationCategoryRepository;

    public function __construct(LawsRegulationCategory $lawsRegulationCategoryRepository) { 
        $this->lawsRegulationCategoryRepository = $lawsRegulationCategoryRepository;
    }

    public function listDataLawTravel() { 
        $data = $this->lawsRegulationCategoryRepository->with(['lawregulations' => function ($query) {
            $query->leftJoin('mapping_langs', 'laws_regulations.id', '=', 'mapping_langs.master_id');
            $query->where('mapping_langs.code_lang',App::getLocale());
            $query->where('mapping_langs.module','laws-regulations');
            $query->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        }])
            ->where('title','พระราชบัญญัติกฏหมายท่องเที่ยว')
            ->where('type',1)
            ->where('status',1)
            ->get()->toArray();

        if(count($data) <= 0){
            $data = $this->lawsRegulationCategoryRepository->with(['lawregulations' => function ($query) {
                $query->leftJoin('mapping_langs', 'laws_regulations.id', '=', 'mapping_langs.master_id');
                $query->where('mapping_langs.code_lang','th');
                $query->where('mapping_langs.module','laws-regulations');
                $query->select('laws_regulations.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            }])
                ->where('title','พระราชบัญญัติกฏหมายท่องเที่ยว')
                ->where('type',1)
                ->where('status',1)
                ->get()->toArray();
        }
       return $data;
    }

    public function listDataLawDecree() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','พระราชกฤษฏีกากฏหมายท่องเที่ยว')
        ->where('type',1)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawministerial() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','กฎกระทรวง')
        ->where('type',1)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawruleoftravel() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','ระเบียบกฏหมายท่องเที่ยว')
        ->where('type',1)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawconstitution() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','รัฐธรรมนูญ')
        ->where('type',2)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawact() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','พระราชบัญญัติ')
        ->where('type',2)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawordinance() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','พระราชกฤษฏีกา')
        ->where('type',2)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawregularity() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','ระเบียบ')
        ->where('type',2)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listDataLawannounce() { 
        $data = $this->lawsRegulationCategoryRepository->with('lawregulations')
        ->where('title','ประกาศ')
        ->where('type',2)
        ->where('status',1)
        ->get()->toArray();
        return $data;
    }

    public function listCategoryById(int $id) {
        return $this->lawsRegulationCategoryRepository->where('id',$id)->get()->toArray();
    }
}
