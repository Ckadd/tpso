<?php

namespace App\Repository;

use App\model\StandardTourismPersonnel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
class StandardTourismPersonnalRepository { 

    protected $standardTourismPersonnalRepository;

    public function __construct(StandardTourismPersonnel $standardTourismPersonnalRepository) { 
        $this->standardTourismPersonnalRepository = $standardTourismPersonnalRepository;
    }

    public function listData() { 
        try{
            $data['data'] = $this->standardTourismPersonnalRepository->leftJoin('mapping_langs', 'standard_tourism_personnels.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'standard-tourism-personnels')
                ->where('standard_tourism_personnels.status',1)
                ->orderBy('standard_tourism_personnels.sort_order','ASC')
                ->get()->toArray();
            if(!empty($data['data'])) { 
                $data['count'] = COUNT($data['data']);
                return $data;
            }else{
                $data['data'] = $this->standardTourismPersonnalRepository->leftJoin('mapping_langs', 'standard_tourism_personnels.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'standard-tourism-personnels')
                    ->where('standard_tourism_personnels.status',1)
                    ->orderBy('standard_tourism_personnels.sort_order','ASC')
                    ->get()->toArray();
                if(!empty($data['data'])) {
                    $data['count'] = COUNT($data['data']);
                    return $data;
                }
            }
            

        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}
