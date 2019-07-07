<?php

namespace App\Repository;

use App\Model\ChartStatistic;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
class ChartStatisticRepository
{
    protected $chartStatisticRepository;

    public function __construct(ChartStatistic $chartStatisticRepository)
    {
        $this->chartStatisticRepository = $chartStatisticRepository;
    }

    public function listdata() { 
        try {
            $arrData = $this->chartStatisticRepository::leftJoin('mapping_langs', 'chart_statistics.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'chart-statistics')
            ->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('chart_statistics.sort_order','ASC')
            ->get()
            ->toArray();
            if(count($arrData) <= 0){
                $arrData = $this->chartStatisticRepository::leftJoin('mapping_langs', 'chart_statistics.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'chart-statistics')
                ->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('chart_statistics.sort_order','ASC')
                ->get()
                ->toArray();
            }
            return $arrData;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listDataById(int $id) { 
        try {
            $queryData = $this->chartStatisticRepository->leftJoin('mapping_langs', 'chart_statistics.id', '=', 'mapping_langs.master_id');
            $queryData->where('mapping_langs.code_lang',App::getLocale());
            $queryData->where('mapping_langs.module','chart-statistics');
            $queryData->where('chart_statistics.id',$id);
            $queryData->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->get();
            
            if(isset($queryData)){
                $queryData = $queryData->toArray();
            }else{
                $queryData = MappingLang::join('chart_statistics', 'mapping_langs.master_id', '=', 'chart_statistics.id')
                    ->where('mapping_langs.parent_id',$id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','chart-statistics')
                    ->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->get();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }else{
                    $f_queryData = MappingLang::join('chart_statistics', 'mapping_langs.master_id', '=', 'chart_statistics.id')
                        ->where('mapping_langs.master_id',$id)
                        //->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','chart-statistics')
                        ->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->first();
                    $queryData = MappingLang::join('chart_statistics', 'mapping_langs.master_id', '=', 'chart_statistics.id')
                        ->where('mapping_langs.master_id',$f_queryData->parent_id)
                        ->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','chart-statistics')
                        ->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->get();
                    if(isset($queryData)) {
                        $queryData = $queryData->toArray();
                    }
                }
            }
            if(count($queryData) <= 0){
                $queryData = $this->chartStatisticRepository->leftJoin('mapping_langs', 'chart_statistics.id', '=', 'mapping_langs.master_id');
                $queryData->where('mapping_langs.code_lang','th');
                $queryData->where('mapping_langs.module','chart-statistics');
                $queryData->where('chart_statistics.id',$id);
                $queryData->select('chart_statistics.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                $queryData = $queryData->get()->toArray();
            }
            return $queryData;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
    
}
