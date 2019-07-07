<?php
namespace App\Repository;

use App\Model\DotStatGroup;
use App\Model\DotStatCategory;
use App\Model\DotStatData;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;

class DotStatRepository {
    protected $dotStatGroupModel;
    protected $dotStatCategoryModel;
    protected $dotStatDataModel;

    public function __construct(
        DotStatGroup    $dotStatGroupModel,
        DotStatCategory $dotStatCategoryModel,
        DotStatData     $dotStatDataModel
    )
    {
        $this->dotStatGroupModel    = $dotStatGroupModel;
        $this->dotStatCategoryModel = $dotStatCategoryModel;
        $this->dotStatDataModel     = $dotStatDataModel;
    }
    
    public function getMenuData()
    {
        $queryStatGroup = $this->dotStatGroupModel->where('status',1)
            ->orderBy('sort_order','ASC')
            ->get()->toArray();
        $statGroup = [];
        foreach($queryStatGroup as $keyGroup => $valueGroup) {
            $queryStatCategory['category'] = $this->dotStatCategoryModel::where([
                'status' => 1,
                'stat_group_id' => $valueGroup['id']
            ])
            ->orderBy('sort_order','ASC')
            ->get()->toArray();

            $statGroup[] = array_merge($queryStatGroup[$keyGroup],$queryStatCategory);
        }

        return $statGroup;
    }

    public function listDataCategory(int $id)
    {
        try {

            return $this->dotStatCategoryModel::findOrFail($id)->toArray();

        }catch(ModelNotFoundException $e) {

            return [];
        }
    }

    public function getDataSearch(int $category, int $month, int $year)
    {
        $nowYear = $year - 543;
        $resData = $this->dotStatDataModel::leftJoin('mapping_langs', 'dot_stat_datas.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','dot-stat-datas')
            ->select('dot_stat_datas.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->where('dot_stat_datas.stat_cate_id',$category)
            ->whereYear('dot_stat_datas.date',$nowYear)
            ->whereMonth('dot_stat_datas.date',$month)
            ->get()
            ->toArray();
        if(count($resData) <= 0) {
            $resData = $this->dotStatDataModel::leftJoin('mapping_langs', 'dot_stat_datas.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang','th')
                ->where('mapping_langs.module','dot-stat-datas')
                ->select('dot_stat_datas.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->where('dot_stat_datas.stat_cate_id',$category)
                ->whereYear('dot_stat_datas.date',$nowYear)
                ->whereMonth('dot_stat_datas.date',$month)
                ->get()
                ->toArray();
        }
        return $resData;
    }

    public function listStatData(int $id)
    {
        try {

            return $this->dotStatDataModel::findOrFail($id)->toArray();

        }catch(ModelNotFoundException $e) {

            return [];
        }
    }
}
