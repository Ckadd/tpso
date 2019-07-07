<?php

namespace App\Repository;

use App\Model\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;
class ArticleRepository
{
    protected $articleRepository;

    public function __construct(Article $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function listdata() { 
        try {
            $articleFirst = $this->articleRepository->leftJoin('mapping_langs', 'articles.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','articles')
                ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->where('articles.status',1)
                ->orderBy('articles.sort_order','ASC')
                ->first()->toArray();
            if(empty($articleFirst)){
                $articleFirst = $this->articleRepository->leftJoin('mapping_langs', 'articles.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','articles')
                    ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->where('articles.status',1)
                    ->orderBy('articles.sort_order','ASC')
                    ->first()->toArray();
            }

            $articleList = $this->articleRepository->leftJoin('mapping_langs', 'articles.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','articles')
                ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->where('articles.status',1)
                ->where('articles.sort_order','!=',1)
                ->orderBy('articles.sort_order','ASC')
                ->take(3)
                ->get()->toArray();
            if(count() <= 0){
                $articleList = $this->articleRepository->leftJoin('mapping_langs', 'articles.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','articles')
                    ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->where('articles.status',1)
                    ->where('articles.sort_order','!=',1)
                    ->orderBy('articles.sort_order','ASC')
                    ->take(3)
                    ->get()->toArray();
            }

            $article['articleFirst'] = $articleFirst;
            $article['articleList'] = $articleList;

            return $article;
            
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listDataDetail(int $id) {
        /*return $this->articleRepository::find($id)->toArray();*/
        return $this->queryByIdDetail($id);

    }

    private function queryByIdDetail($id){
        $queryData = $this->articleRepository->leftJoin('mapping_langs', 'articles.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','articles')
            ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->where('articles.id',$id)
            ->orderBy('articles.sort_order','ASC')
            ->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('articles', 'mapping_langs.master_id', '=', 'articles.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','articles')
                ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('articles', 'mapping_langs.master_id', '=', 'articles.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','articles')
                    ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('articles', 'mapping_langs.master_id', '=', 'articles.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','articles')
                    ->select('articles.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }
        return $queryData;
    }
}
