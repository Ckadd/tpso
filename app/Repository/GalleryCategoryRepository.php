<?php

namespace App\Repository;

use App\model\GalleryCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Model\Gallery;
use  App;
class GalleryCategoryRepository { 

    protected $galleryCategoryRepository;
    protected $galleryRepository;

    public function __construct(GalleryCategory $galleryCategoryRepository,Gallery $galleryRepository) { 
        $this->galleryCategoryRepository = $galleryCategoryRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function checkCategoryHomepage() {
        try{
            $checkCategoryHomePage = $this->galleryCategoryRepository->select('name')
            ->where('name','HomePage')->get()->toArray();
            dd($checkCategoryHomePage);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listCategoryHomepage() {
        try{
            $queryCategoryHomePage = $this->galleryCategoryRepository->select('id')
            ->where('name','HomePage')
            ->where('status',1)
            ->get()->toArray();
            
            if(!empty($queryCategoryHomePage)) {
                $dataGallery = $this->galleryRepository
                    ->where('category_id',$queryCategoryHomePage[0]['id'])
                    ->with(['galleryItem' => function ($query) {
                        $query->leftJoin('mapping_langs', 'gallery_items.id', '=', 'mapping_langs.master_id');
                        $query->where('mapping_langs.code_lang',App::getLocale());
                        $query->where('mapping_langs.module','gallery-items');
                        $query->orderBy('gallery_items.sort_order','ASC');
                        $query->select('gallery_items.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                    }])
                    ->get()
                    ->toArray();
                    
                if(COUNT($dataGallery[0]['gallery_item']) <= 0) {
                    $dataGallery = $this->galleryRepository
                    ->where('category_id',$queryCategoryHomePage[0]['id'])
                    ->with(['galleryItem' => function ($query) {
                        $query->leftJoin('mapping_langs', 'gallery_items.id', '=', 'mapping_langs.master_id');
                        $query->where('mapping_langs.code_lang','th');
                        $query->where('mapping_langs.module','gallery-items');
                        $query->orderBy('gallery_items.sort_order','ASC');
                        $query->select('gallery_items.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                    }])
                    ->get()
                    ->toArray();
                }
                
                if($dataGallery[0]['display'] > count($dataGallery[0]['gallery_item'])) {
                    $galleryView = $dataGallery[0]['gallery_item'];
                    $checkStatus = $this->checkEmptyData($galleryView);
                    
                    return $checkStatus;
                }else {
                    $x = 0;
                    
                    $counGallery = count($dataGallery[0]['gallery_item']);
                   
                    for($i=1; $i <= $counGallery; $i++) {
                        // array_pop($dataGallery[0]['gallery_item']);
                        if($i > $dataGallery[0]['display'] ){
                            unset($dataGallery[0]['gallery_item'][$x]);
                        }
                        $x++;
                     
                    }
                    
                    $checkStatus = $this->checkEmptyData($dataGallery[0]['gallery_item']);
                    
                    return $checkStatus;
                }
            }else{

                // value empty
               return [];
            }
           
            
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function listCategoryDepartment($id) {
        try{
            $dataGallery = $this->galleryRepository->leftJoin('mapping_langs', 'galleries.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','galleries')
                ->select('galleries.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->where('galleries.organization_id',$id)
                ->with(['galleryItem' => function ($query) {
                    $query->leftJoin('mapping_langs', 'gallery_items.id', '=', 'mapping_langs.master_id');
                    $query->where('mapping_langs.code_lang',App::getLocale());
                    $query->where('mapping_langs.module','gallery-items');
                    $query->select('gallery_items.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                }])
                ->get()
                ->toArray();

            if(empty($dataGallery)){
                $dataGallery = $this->galleryRepository->leftJoin('mapping_langs', 'galleries.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','galleries')
                    ->select('galleries.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->where('galleries.organization_id',$id)
                    ->with(['galleryItem' => function ($query) {
                        $query->leftJoin('mapping_langs', 'gallery_items.id', '=', 'mapping_langs.master_id');
                        $query->where('mapping_langs.code_lang','th');
                        $query->where('mapping_langs.module','gallery-items');
                        $query->select('gallery_items.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
                    }])
                    ->get()
                    ->toArray();
            }

            if(!empty($dataGallery)){
                $galleryOrganization = [];
                foreach($dataGallery[0]['gallery_item'] as $keyOraganization => $valueOraganization) { 
                    ($valueOraganization['status'] == 1)? $galleryOrganization[]=$valueOraganization : "";
                }
                
                if($dataGallery[0]['display'] > count($galleryOrganization) || $dataGallery[0]['display'] == count($galleryOrganization)) {
                    $galleryView = $galleryOrganization;
                    
                    return $galleryView;
                }else {
                    
                    $i = 1;
                    while($i <= $dataGallery[0]['display']) {
                        array_pop($galleryOrganization);
                        $i++;
                    }
                    
                    return $galleryOrganization;
                }
            }else{
                return [];
            }

        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    public function checkEmptyData(array $data) {
        
        $checkStatus = [];
        if(!empty($data)) {
            foreach($data as $valueGallery) {
                ($valueGallery['status'] == 1) ? $checkStatus[] = $valueGallery : [];
            }
                    
        }
        
        return $checkStatus;
    }
}
