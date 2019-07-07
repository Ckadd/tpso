<?php 

namespace App\Repository;
use App\Model\LibraryBookView;

class LibraryBookViewRepository { 
    
    protected $libraryBookViewRepository;

    public function __construct(LibraryBookView $libraryBookViewRepository) {
        $this->libraryBookViewRepository = $libraryBookViewRepository;
    }

    public function addlogByViewPage($id){
        try{
            return $this->libraryBookViewRepository->insert([
                    'library_book_id' => $id,
                    'ip'         => $_SERVER['REMOTE_ADDR'],
                    'type'       => 'view',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function addlogByShareSocialPage(int $id,string $type){ 
        try{
            return $this->libraryBookViewRepository->insert([
                    'library_book_id' => $id,
                    'ip'         => $_SERVER['REMOTE_ADDR'],
                    'type'       => $type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogView() {
        try{
            $contentId = $this->libraryBookViewRepository->select('library_book_id')
            ->distinct()
            ->get()
            ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId[$val['library_book_id']] = $this->libraryBookViewRepository
                ->select('id')
                ->where('library_book_id',$val['library_book_id'])
                ->where('type','view')
                ->count();
            }
            return $mergeContentId;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogById($id) {
        try{
            $type = ['view','facebook','twitter','googleplus'];
            
            foreach($type as $val) { 
                $allLog[$val] = $this->libraryBookViewRepository
                ->select('id')
                ->where('library_book_id',$id)
                ->where('type',$val)
                ->count();
            }
            $newAllLog['social']=$allLog;
            return $newAllLog;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listLogByCategory(array $id) {

            $mergeContentId = [];
            foreach($id as $val) { 
                $mergeContentId[$val] = $this->libraryBookViewRepository
                ->select('id')
                ->where('library_book_id',$val)
                ->where('type','view')
                ->count();
            }
            return $mergeContentId;
    }

    
}