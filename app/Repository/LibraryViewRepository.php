<?php

namespace App\Repository;

use App\model\LibraryView;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LibraryViewRepository { 

    protected $libraryViewRepository;

    public function __construct(LibraryView $libraryViewRepository) { 
        $this->libraryViewRepository = $libraryViewRepository;
    }

    public function listDataById($id) {

        dd($this->libraryViewRepository::find($id));
    }

    public function addLogView($id,string $type) { 
        try {
            $this->libraryViewRepository->insert([
                'library_id'=> $id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function findLogViewByid($id) { 
        try {
            return $this->libraryViewRepository
            ->select('id')->where('library_id',$id)->where('type','view')->count();
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listAllLogView() {
        try{
            $contentId = $this->libraryViewRepository->select('library_id')
            ->distinct()
            ->get()
            ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId['allLogView'][$val['library_id']] = $this->libraryViewRepository
                ->select('id')
                ->where('library_id',$val['library_id'])
                ->where('type','view')
                ->count();
            }
            return $mergeContentId;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            $this->libraryViewRepository->insert([
                'library_id'=> $id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function findLogSocialById(int $id) {
        try {
                $type = ['facebook','twitter','googleplus'];
                $newtype = [];
                foreach($type as $key => $val) {
                    $newtype['social'][$val] = $this->libraryViewRepository
                    ->select('id')->where('library_id',$id)->where('type',$val)->count();
                }
                return $newtype;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}