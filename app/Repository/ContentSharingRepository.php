<?php

namespace App\Repository;

use App\model\ContentSharing;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;

class ContentSharingRepository { 

    protected $contentSharingModel;

    public function __construct(ContentSharing $contentSharingModel) { 
        $this->contentSharingModel = $contentSharingModel;
    }

    public function listDataByOrder($id)
    {
        try{
            $dataArr = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'content-sharings')
                ->where(['content_sharings.status'=>1,'content_sharings.sort_order'=>$id])
                ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->get()
                ->toArray();
            if(count($dataArr) <= 0){
                $dataArr = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'content-sharings')
                    ->where(['content_sharings.status'=>1,'content_sharings.sort_order'=>$id])
                    ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->get()
                    ->toArray();
            }
            return $dataArr;
        }catch(ModelNotFoundException $e){ 
            return [];
        }
    }

    public function listDataBySortOrder()
    {
        try{
            $dataArr = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'content-sharings')
                ->where('content_sharings.sort_order','!=',Null)
                ->where('content_sharings.sort_order','!=',1)
                ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('content_sharings.sort_order','ASC')
                ->get()
                ->toArray();
            if(count($dataArr) <= 0){
                $dataArr = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'content-sharings')
                    ->where('content_sharings.sort_order','!=',Null)
                    ->where('content_sharings.sort_order','!=',1)
                    ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('content_sharings.sort_order','ASC')
                    ->get()
                    ->toArray();
            }
            return $dataArr;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listDataById($id)
    {
        try{
            $queryData = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id');
            $queryData->where('mapping_langs.code_lang',App::getLocale());
            $queryData->where('mapping_langs.module','content-sharings');
            $queryData->where('content_sharings.id',$id);
            $queryData->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->get();
            if(isset($queryData)){
                $queryData = $queryData->toArray();
            }else{
                $queryData = MappingLang::join('content_sharings', 'mapping_langs.master_id', '=', 'content_sharings.id')
                    ->where('mapping_langs.parent_id',$id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','content-sharings')
                    ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->get();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }else{
                    $f_queryData = MappingLang::join('content_sharings', 'mapping_langs.master_id', '=', 'content_sharings.id')
                        ->where('mapping_langs.master_id',$id)
                        //->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','content-sharings')
                        ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->first();
                    $queryData = MappingLang::join('content_sharings', 'mapping_langs.master_id', '=', 'content_sharings.id')
                        ->where('mapping_langs.master_id',$f_queryData->parent_id)
                        ->where('mapping_langs.code_lang',App::getLocale())
                        ->where('mapping_langs.module','content-sharings')
                        ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                        ->get();
                    if(isset($queryData)) {
                        $queryData = $queryData->toArray();
                    }
                }
            }
            //df lang
            if(count($queryData) <= 0){
                $queryData = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id');
                $queryData->where('mapping_langs.code_lang','th');
                $queryData->where('mapping_langs.module','content-sharings');
                $queryData->where('content_sharings.id',$id);
                $queryData->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                $queryData = $queryData->get()->toArray();
            }
            return $queryData;
        }catch(ModelNotFoundException $e){ 
            return [];
        }
    }

    public function listdataFontend() { 
        try {
            $data = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','content-sharings')
                ->where('content_sharings.status',1)
                ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('content_sharings.sort_order','ASC')
                ->take(4)
                ->get()
                ->toArray();
            if(count($data) <= 0){
                $data = $this->contentSharingModel->leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','content-sharings')
                    ->where('content_sharings.status',1)
                    ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('content_sharings.sort_order','ASC')
                    ->take(4)
                    ->get()
                    ->toArray();
            }

            $contentSharing['contentlist'] = $data;

            $contentSharing['Firstcontent'] = array_shift($contentSharing['contentlist']);
            
            return $contentSharing;
            
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}
