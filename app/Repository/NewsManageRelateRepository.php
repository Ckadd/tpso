<?php

namespace App\Repository;

use App\Model\NewManagerRelated;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\News;

class NewsManageRelateRepository {
    protected $newManageRelateModel;
    protected $newsModel;

    public function __construct(
        NewManagerRelated $newManageRelateModel,
        News $newsModel
    ){
        $this->newManageRelateModel = $newManageRelateModel;
        $this->newsModel            = $newsModel;
    }

    public function updateNewsRelate(array $news,int $id) {
        $this->newManageRelateModel->where('new_manage_id',$id)->delete();
        $userId = Auth::user()->id;
       
        foreach($news as $valueNew) {
            $this->newManageRelateModel->insert([
                'new_manage_id' => $id,
                'new_relate_id' => $valueNew,
                'create_by'     => $userId,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
        
        return;
    }
    
    public function listRelatedByManageId(int $id) {
        $dataManage = $this->newManageRelateModel->where('new_manage_id',$id)
        ->take(4)
        ->get()->toArray();
        
        $idNews = array_column($dataManage,'new_relate_id');
        $news = $this->newsModel->whereIn('id',$idNews)
        ->where('status',1)
        ->get()->toArray();
       
        return $news;
    }
}