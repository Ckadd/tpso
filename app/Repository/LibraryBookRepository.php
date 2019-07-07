<?php 

namespace App\Repository;
use App\Model\LibraryBook;
use App\Model\MappingLang;
use App;
class LibraryBookRepository { 
    
    protected $libraryBookRepository;

    public function __construct(LibraryBook $libraryBookRepository) {
        $this->libraryBookRepository = $libraryBookRepository;
    }

    public function getAll() {
        $data = $this->libraryBookRepository::leftJoin('mapping_langs', 'library_books.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'library-books')
            ->where('library_books.status','=',1)
            ->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('library_books.sort_order','ASC')
            ->get()
            ->toArray();
        if(count($data) <= 0){
            $data = $this->libraryBookRepository::leftJoin('mapping_langs', 'library_books.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'library-books')
                ->where('library_books.status','=',1)
                ->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('library_books.sort_order','ASC')
                ->get()
                ->toArray();
        }
        return $data;
    }

    public function getDataById(int $id) {
        $queryData = $this->libraryBookRepository->leftJoin('mapping_langs', 'library_books.id', '=', 'mapping_langs.master_id');
        $queryData->where('library_books.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','library-books');
        $queryData->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('library_books', 'mapping_langs.master_id', '=', 'library_books.id')
                ->where('mapping_langs.parent_id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','library-books')
                ->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('library_books', 'mapping_langs.master_id', '=', 'library_books.id')
                    ->where('mapping_langs.master_id',$id)
                    //->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','library-books')
                    ->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('library_books', 'mapping_langs.master_id', '=', 'library_books.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','library-books')
                    ->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }

        if(count($queryData) <= 0){
            $queryData = $this->libraryBookRepository->leftJoin('mapping_langs', 'library_books.id', '=', 'mapping_langs.master_id');
            $queryData->where('library_books.id',$id);
            $queryData->where('mapping_langs.code_lang','');
            $queryData->where('mapping_langs.module','library-books');
            $queryData->select('library_books.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first()->toArray();
        }
        return $queryData;
    }

    public function getCategoryById(int $id) {
        return $this->libraryBookRepository::where('category_library_book_id',$id)
        ->get()->toArray();
    }

}
