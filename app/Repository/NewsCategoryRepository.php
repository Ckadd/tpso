<?php
    
namespace App\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Model\User;
use App\Model\NewsCategoryOrganization;
use App\Model\NewsCategory;
use App\Model\News;
use App\Model\NewsView;
use Carbon\Carbon;
use App\Model\Organization;
use App;
use App\Model\MappingLang;
use App\Model\NewsOrganization;
class NewsCategoryRepository
{
    protected $userModel;

    protected $newsCategoryOrganization;
    protected $newCategory;
    protected $news;
    protected $newViews;
    protected $organization;
    protected $newOrganizationModel;

    public function __construct(
        User $userModel,
        NewsCategoryOrganization $newsCategoryOrganization,
        NewsCategory $newCategory,
        News $news,
        NewsView $newViews,
        Organization $organization,
        NewsOrganization $newOrganizationModel
    ) {
        $this->userModel                = $userModel;
        $this->newsCategoryOrganization = $newsCategoryOrganization;
        $this->newCategory              = $newCategory;
        $this->news                     = $news;
        $this->newViews                 = $newViews;
        $this->organization             = $organization;
        $this->newOrganizationModel     = $newOrganizationModel;
    }

    /**
     * Get category by user.
     *
     * @param mixed $userId
     *
     * @return array
     */
    public function getCategoryByUser($userId)
    {
        try {
            $user = $this->userModel->where('id', $userId)
                ->with('organization')
                ->firstOrFail()
                ->toArray();

            $organizationId = $user['organization']['id'];
            $categoryOrganization = $this->newsCategoryOrganization->where('organization_id', $organizationId)
                ->get()
                ->toArray();
            $categoryOrganization = array_pluck($categoryOrganization, 'news_category_id');

            return $categoryOrganization;
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    // *******START MENU INFORM*******

    public function listDataPressReleases() {

        $queryIdCategory = $this->newCategory->where('name','ข่าวประชาสัมพันธ์')->get()->toArray();
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();
        if(!empty($queryIdCategory) && !empty($queryIdOrganization)) {
            $id=$queryIdCategory[0]['id'];
            $idOrganization = $queryIdOrganization[0]['id'];
            $queryNews = $this->queryListNews($id,$idOrganization,10);
            
            // foreach($queryNews as $keynew => $valuenew) {
            //     $countView['view'] = $this->newViews->where('new_id',$valuenew['id'])->count();
            //     dd($queryNews[$keynew]);
            //     $queryNews[$keynew] = array_merge($queryNews[$keynew],$countView);
            // }

            // $queryNews = array_chunk($queryNews,2);
            // $queryNews->chunk(2);
            // dd($queryNews);
            return $queryNews;
        }
    }

    public function listDataPressReleasesById(int $id) {
        $queryData = $this->queryNewDetail($id);
        $view = $this->newViews->where('new_id',$id)
            ->where('type','view')->count();

        $data['alldata'] = $queryData;
        $data['views'] = $view;

        return $data;
    }

    public function listDataInformByOrganization(int $id) {

        $queryIdCategory = $this->newCategory->where('name','ข่าวประชาสัมพันธ์')->get()->toArray();

        if(!empty($queryIdCategory)) {
            $categoryId = $queryIdCategory[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            $queryNews = $this->getDataOrganizationByCategory($categoryId,$allIdNews,0,10);
            
            // foreach($queryNews as $keynew => $valuenew) {
            //     $countView['view'] = $this->newViews->where('new_id',$valuenew['id'])->count();
            //     $queryNews[$keynew] = array_merge($queryNews[$keynew],$countView);
            // }
            // $queryNews = array_chunk($queryNews,2);

            return $queryNews;
        }
    }

    // *******END MENU INFORM*******

    // *******START MENU INSTITUTION*******

    public function listDataInstitution() {
        $queryIdCategory = $this->newCategory->where('name','ข่าวหน่วยงาน')->get()->toArray();
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();

        if(!empty($queryIdCategory) && !empty($queryIdOrganization)) {
            $id=$queryIdCategory[0]['id'];
            $idOrganization = $queryIdOrganization[0]['id'];
            $queryNews = $this->queryListNews($id,$idOrganization,7);

            return $queryNews;
        }

        return [];
    }

    public function listDataInstitutionById(int $id) {
        $queryData = $this->queryNewDetail($id);
        $view = $this->newViews->where('new_id',$id)
        ->where('type','view')->count();

        $data['alldata'] = $queryData;
        $data['views'] = $view;

        return $data;
    }

    public function listDataInstitutionByOrganization(int $id) {
        $queryIdCategory = $this->newCategory->where('name','ข่าวหน่วยงาน')->get()->toArray();
        
        if(!empty($queryIdCategory)) {
            $categoryId = $queryIdCategory[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            return $this->getDataOrganizationByCategory($categoryId,$allIdNews,0,7);
        }
    }
    // *******END MENU INSTITUTION*******


    // *******START MENU MANAGE*******

    public function listDataManager() {
        $queryIdCategory = $this->newCategory->where('name','ข่าวผู้บริหาร')->get()->toArray();
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();
        if(!empty($queryIdCategory) && !empty($queryIdOrganization)) {
            $id=$queryIdCategory[0]['id'];
            $idOrganization = $queryIdOrganization[0]['id'];
            $queryNews = $this->queryListNews($id,$idOrganization,10);
        
            // foreach($queryNews as $keynew => $valuenew) {
            //     $countView['view'] = $this->newViews->where('new_id',$valuenew['id'])->count();
            //     $queryNews[$keynew] = array_merge($queryNews[$keynew],$countView);
            // }
            // $queryNews = array_chunk($queryNews,2);

            return $queryNews;
        }

        return [];
    }

    public function listDataManagerById(int $id) {
        $queryData = $this->queryNewDetail($id);
        $view = $this->newViews->where('new_id',$id)->where('type','view')->count();
        $data['alldata'] = $queryData;
        $data['views'] = $view;
        
        return $data;
    }

    public function listDataManagerByOrganization(int $id) {
        $queryIdCategory = $this->newCategory->where('name','ข่าวผู้บริหาร')->get()->toArray();
        
        if(!empty($queryIdCategory) ) {
            $categoryId = $queryIdCategory[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            $queryNews = $this->getDataOrganizationByCategory($categoryId,$allIdNews,0,10);
            // foreach($queryNews as $keynew => $valuenew) {                
            //     $countView['view'] = $this->newViews->where('new_id',$valuenew['id'])->count();
            //     $queryNews[$keynew] = array_merge($queryNews[$keynew],$countView);
            // }
            // $queryNews = array_chunk($queryNews,2);

            return $queryNews;
        }
    }
    // *******END MENU MANAGE*******

    // *******START MENU PROCUREMENT*******
    public function listDataProcurement() {
        $queryIdCategory = $this->newCategory->where('name','ข่าวจัดซื้อจัดจ้าง')->get()->toArray();
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();
        if(!empty($queryIdCategory) && !empty($queryIdOrganization)) {
            $id=$queryIdCategory[0]['id'];
            $idOrganization = $queryIdOrganization[0]['id'];
            $queryNews = $this->queryListNews($id,$idOrganization,8);

            return $queryNews;
        }
    }

    public function listDataProcurementById(int $id) {
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();
        $organizationId = (!empty($queryIdOrganization)) ? $queryIdOrganization[0]['id'] : 0;
        $queryData = $this->queryNewDetail($id,$organizationId);
        $view = $this->newViews->where('new_id',$id)->where('type','view')->count();
        $data['alldata'] = $queryData;
        $data['views'] = $view;
        
        return $data;
    }


    // *******END MENU PROCUREMENT*******
    
    // news guide
    public function listDataGuide() {
        $queryIdCategory = $this->newCategory->where('name','ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์')->get()->toArray();
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();
        if(!empty($queryIdCategory) && !empty($queryIdOrganization)) {
            $id=$queryIdCategory[0]['id'];
            $idOrganization = $queryIdOrganization[0]['id'];
            $queryNews = $this->queryListNews($id,$idOrganization,7);

            return $queryNews;
        }

        return [];
    }


    // ADD LOG VIEWS
    public function addLogView(int $id,string $type) {
        $this->newViews->insert([
            'new_id' => $id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'type' => $type,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function addLogBysocialPage(int $id,string $type) { 
        try {
            
            $this->newViews->insert([
                'new_id'=> $id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    // ------------ function fontend --------------
    public function listNewsPostLastContent() {
        $groupNewsList = ['ข่าวผู้บริหาร','ข่าวจัดซื้อจัดจ้าง','ข่าวหน่วยงาน','ข่าวประชาสัมพันธ์','ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'];
        $idNewGroup = []; 
        foreach($groupNewsList as $keygroup => $valgroup) {
            $data = $this->newCategory->select('id')
            ->where('name',$valgroup)
            ->get()->toArray();
            $idNewGroup[] = $data[0];
        }

        //id organization
        $queryIdOrganization = $this->organization->where('name','กรมการท่องเที่ยว')->get()->toArray();
        $organizationId = (!empty($queryIdOrganization)) ? $queryIdOrganization[0]['id'] : 0;
        $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$organizationId)->get()->toArray();
        $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];

        $lastPostNews = [];
        foreach($idNewGroup as $keyid => $valid) {
             $resData= $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','news')
                ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->where('news.category_id',$valid)
                ->whereIn('news.id',$allIdNews)
                ->where('news.status',1)
                ->orderBy('news.datetime','DESC')
                ->orderBy('news.sort_order','DESC')
                ->take(1)
                ->get()->toArray();
           
            if(count($resData) <= 0) {
                $resData = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang', 'th')
                    ->where('mapping_langs.module', 'news')
                    ->select('news.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                    ->where('news.category_id', $valid)
                    ->whereIn('news.id',$allIdNews)
                    ->where('news.status', 1)
                    ->orderBy('news.datetime', 'DESC')
                    ->orderBy('news.sort_order', 'DESC')
                    ->take(1)
                    ->get()->toArray();
            }
            $lastPostNews[$groupNewsList[$keyid]] = $resData;
        }
        
        return $lastPostNews;
    }

    public function NewPressReleasesByDepartmentId(int $id) {

        $idNewGroup = $this->newCategory->select('id')
            ->where('name',"ข่าวประชาสัมพันธ์")
            ->get()->toArray();

        if(!empty($idNewGroup)){
            $categoryId = $idNewGroup[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            
            return $this->getDataOrganizationByCategory($categoryId,$allIdNews,5,10);
        }
        return [];
    }

    public function NewManageByDepartmentId(int $id) {

        $idNewGroup = $this->newCategory->select('id')
            ->where('name',"ข่าวผู้บริหาร")
            ->get()->toArray();

        if(!empty($idNewGroup)){
            $categoryId = $idNewGroup[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            
            return $this->getDataOrganizationByCategory($categoryId,$allIdNews,3,10);
        }
        return [];
    }

    public function NewActivitiesByDepartmentId(int $id) {
        $idNewGroup = $this->newCategory->select('id')
        ->where('name',"ข่าวกิจกรรม")
        ->get()->toArray();
        
        if(!empty($idNewGroup)){
            $categoryId = $idNewGroup[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            
            return $this->getDataOrganizationByCategory($categoryId,$allIdNews,3,7);
        }
       
        return [];
    }

    public function NewAnnounceByDepartmentId(int $id) {
        
        $idNewGroup = $this->newCategory->select('id')
        ->where('name',"ข่าวหน่วยงาน")
        ->get()->toArray();
        
        if(!empty($idNewGroup)){
            $categoryId = $idNewGroup[0]['id'];
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$id)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            
            return $this->getDataOrganizationByCategory($categoryId,$allIdNews,5,7);
        }
        
        return [];
    }
    
    /**
     * new another listDetail
     * @param int $id
     */
    
    public function listdataDetailAnother(int $id) {
        $queryData = $this->queryNewDetail($id);
        $view = $this->newViews->where('new_id',$id)
        ->where('type','view')->count();
        $data['category'] = [];
        if(!empty($queryData['category_id'])) {
            $data['category'] = $this->newCategory::find($queryData['category_id'])->toArray();
        }
        $data['alldata'] = $queryData;
        $data['views'] = $view;

        return $data;
    }

    public function newManagerId() {
        $queryId = $this->newCategory->where('name','ข่าวผู้บริหาร')->get()->toArray();
        ($queryId != [])? $id = $queryId[0]['id'] : $id = [];

        return $id;
    }

    public function findNewById($id) {
        return $this->news::where('id',$id)->get()->toArray();
    }

    public function listNewRelate(array $organizationId,int $categoryId,int $id) {
        return $this->news->where('status',1)
        ->whereIn('organization_id',$organizationId)
        ->where('category_id',$categoryId)
        ->where('id','!=',$id)
        ->orderBy('sort_order','ASC')
        ->orderBy('datetime','ASC')
        ->get()->toArray();
    }

    private function queryListNews($id,$idOrganization,$countData){
        $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$idOrganization)->get()->toArray();
        
        $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
        $queryNews = $this->news->where('news.category_id',$id);
        $queryNews->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id');
        $queryNews->where('mapping_langs.code_lang',App::getLocale());
        $queryNews->where('mapping_langs.module','news');
        $queryNews->where('news.status',1);
        
        $queryNews->where(function($query) {
            $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
            $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
            $query->orWhere('news.start_date',null);
        });

        $queryNews->whereIn('news.id',$allIdNews);
        $queryNews->orderBy('news.datetime','DESC');
        $queryNews->orderBy('news.sort_order','ASC');
        $queryNews->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryNews = $queryNews->paginate($countData);
        
        if(count($queryNews) <= 0){
            $queryNews = $this->news->where('news.category_id',$id);
            $queryNews->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id');
            $queryNews->where('mapping_langs.code_lang','th');
            $queryNews->where('mapping_langs.module','news');
            $queryNews->where('news.status',1);
            $queryNews->orWhere('news.start_date',null);
            
            $queryNews->where(function($query) {
                $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
                $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
                $query->orWhere('news.start_date',null);
            });

            $queryNews->whereIn('news.id',$allIdNews);
            $queryNews->orderBy('news.datetime','DESC');
            $queryNews->orderBy('news.sort_order','ASC');
            $queryNews->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryNews = $queryNews->get()->toArray();
        }

        return $queryNews;
    }

    private function queryNewDetail($id){
        $queryData = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id');
        $queryData->where('news.id',$id);
        $queryData->where('mapping_langs.code_lang',App::getLocale());
        $queryData->where('mapping_langs.module','news');
        $queryData->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryData = $queryData->first();
        
        if($queryData == null) {
            return [];
        }

        if(isset($queryData)){
            $queryData = $queryData->toArray();
        }else{
            $queryData = MappingLang::join('news', 'mapping_langs.master_id', '=', 'news.id')
                ->where('news.id',$id)
                ->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module','news')
                ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }else{
                $f_queryData = MappingLang::join('news', 'mapping_langs.master_id', '=', 'news.id')
                    ->where('news.id',$id)
                    // ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','news')
                    ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                $queryData = MappingLang::join('news', 'mapping_langs.master_id', '=', 'news.id')
                    ->where('mapping_langs.master_id',$f_queryData->parent_id)
                    ->where('mapping_langs.code_lang',App::getLocale())
                    ->where('mapping_langs.module','news')
                    ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->first();
                if(isset($queryData)) {
                    $queryData = $queryData->toArray();
                }
            }
        }
        if(empty($queryData)){
            $queryData = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id');
            $queryData->where('news.id',$id);
            $queryData->where('mapping_langs.code_lang','th');
            $queryData->where('mapping_langs.module','news');
            $queryData->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryData = $queryData->first();
            if(isset($queryData)) {
                $queryData = $queryData->toArray();
            }
        }
        return $queryData;
    }

    public function listInternalAuditPlan(int $organizationId,int $categoryId) {
       
        $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$organizationId)->get()->toArray();
        $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
        return $this->getDataOrganizationByCategory($categoryId,$allIdNews,0,10);
    }

    public function listCategoryId(int $id) {
        return $this->newCategory->where('id',$id)->get()->toArray();
    }

    public function findCategoryById(int $id) {
        return $this->newCategory->where('id',$id)
        ->get()->toArray();
    }

    public function listViewById(int $id) {
        $type = ['facebook','twitter','view'];
        
        $view = [];
        foreach($type as $keyType => $valueType) {
           $view[$valueType] = $this->newViews->where('new_id',$id)
            ->where('type',$valueType)->count();
        }

        return $view;
    }

    private function queryNewsIntranet($id,$idOrganization,$countData){
        $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$idOrganization)->get()->toArray();
        $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
        $queryNews = $this->news->where('news.category_id',$id);
        $queryNews->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id');
        $queryNews->where('mapping_langs.code_lang',App::getLocale());
        $queryNews->where('mapping_langs.module','news');
        $queryNews->where('news.status',1);

        $queryNews->where(function($query) {
            $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
            $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
            $query->orWhere('news.start_date',null);
        });

        $queryNews->whereIn('news.id',$allIdNews);
        $queryNews->orderBy('news.datetime','DESC');
        $queryNews->orderBy('news.sort_order','ASC');
        $queryNews->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
        $queryNews = $queryNews->take($countData)->get()->toArray();
        
        if(count($queryNews) <= 0){
            $queryNews = $this->news->where('news.category_id',$id);
            $queryNews->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id');
            $queryNews->where('mapping_langs.code_lang','th');
            $queryNews->where('mapping_langs.module','news');

            $queryNews->where(function($query) {
                $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
                $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
                $query->orWhere('news.start_date',null);
            }); 

            $queryNews->whereIn('news.id',$allIdNews);
            $queryNews->orderBy('news.datetime','DESC');
            $queryNews->orderBy('news.sort_order','ASC');
            $queryNews->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id');
            $queryNews = $queryNews->take($countData)->get()->toArray();
        }

        return $queryNews;
    }


    public function intranetNews(int $organizationId, string $name, int $countData) {
        $checkCategory = $this->newCategory::where('name',$name)->first();
        if(!empty($checkCategory)) {
            $categoryId = $checkCategory->id;
            
            return $this->queryNewsIntranet($categoryId,$organizationId,$countData);
        }

        return [];
    } 

    public function countNewsByOrganization(array $organizationId, array $date, int $categoryId) {
        
        if(!empty($organizationId) && !empty($date)) {
            if($categoryId == 0) {
                $newByOrganization = [];
                foreach($organizationId as $keyOrganization => $valueOrganization) {
                    $queryNewId = $this->newOrganizationModel::select('news_id')->where('organization_id',$valueOrganization)->get()->toArray();
                    $newId = array_column($queryNewId,'news_id');
                    $newByOrganization[] = $this->news::whereIn('id',$newId)
                        ->whereMonth('created_at',$date[0])
                        ->whereYear('created_at',$date[1])
                        ->count();
                }
            }else {
                $newByOrganization = [];
                foreach($organizationId as $keyOrganization => $valueOrganization) {
                    $queryNewId = $this->newOrganizationModel::select('news_id')->where('organization_id',$valueOrganization)->get()->toArray();
                    $newId = array_column($queryNewId,'news_id');
                    $newByOrganization[] = $this->news::whereIn('id',$newId)
                        ->where('category_id',$categoryId)
                        ->whereMonth('created_at',$date[0])
                        ->whereYear('created_at',$date[1])
                        ->count();
                }
            }
            
            return $newByOrganization;
        }

        $newByOrganization = [];
        foreach($organizationId as $keyOrganization => $valueOrganization) {
            $queryNewId = $this->newOrganizationModel::select('news_id')->where('organization_id',$valueOrganization)->get()->toArray();
            $newId = array_column($queryNewId,'news_id');
            $newByOrganization[] = $this->news::whereIn('id',$newId)
                ->count();
        }
        
        return $newByOrganization;
    }

    /**
     * list data news in organization By categoryId
     *
     * @param integer $categoryId
     * @param array $newsId
     * @param int $take //get take data
     * @return void
     */
    private function getDataOrganizationByCategory(int $categoryId,array $newsId,int $take,int $countData) {
        if($take == 0) {
            $queryNews = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','news')
            ->where('news.category_id',$categoryId)
            ->where('news.status',1)
            
            ->where(function($query) {
                $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
                $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
                $query->orWhere('news.start_date',null);
            })

            ->whereIn('news.id',$newsId)
            ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('news.sort_order','ASC')
            ->paginate($countData);
            
            if(count($queryNews) <= 0){
                $queryNews = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','news')
                    ->where('news.category_id',$categoryId)
                    ->where('news.status',1)
                    
                    ->where(function($query) {
                        $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
                        $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
                        $query->orWhere('news.start_date',null);
                    })
                    
                    ->whereIn('news.id',$newsId)
                    ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('news.sort_order','ASC')
                    ->paginate($countData);
            }
        }else {
            $queryNews = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang',App::getLocale())
            ->where('mapping_langs.module','news')
            ->where('news.category_id',$categoryId)
            ->where('news.status',1)
            
            ->where(function($query) {
                $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
                $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
                $query->orWhere('news.start_date',null);
            })

            ->whereIn('news.id',$newsId)
            ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('news.sort_order','ASC')
            ->take($take)
            ->paginate($countData);
            if(count($queryNews) <= 0){
                $queryNews = $this->news->leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
                    ->where('mapping_langs.code_lang','th')
                    ->where('mapping_langs.module','news')
                    ->where('news.category_id',$categoryId)
                    ->where('news.status',1)
                    
                    ->where(function($query) {
                        $query->whereDate('news.start_date','<=',date('Y-m-d H:i:s'));
                        $query->whereDate('news.end_date','>=',date('Y-m-d H:i:s'));
                        $query->orWhere('news.start_date',null);
                    })

                    ->whereIn('news.id',$newsId)
                    ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                    ->orderBy('news.sort_order','ASC')
                    ->take($take)
                    ->paginate($countData);
            }
        }
        // return $queryNews;
       
        

        return $queryNews;
    }

    public function listCategory() {
        return $this->newCategory::all();
    }

    public function listDataAnother(int $organizationId, int $categoryId) {
        $queryIdCategory = $this->newCategory->where('id',$categoryId)->get()->toArray();
        
        if(!empty($queryIdCategory)) {
            
            $queryIdNew = NewsOrganization::select('news_id')->where('organization_id',$organizationId)->get()->toArray();
            $allIdNews = (!empty($queryIdNew)) ? array_column($queryIdNew,'news_id') : [];
            
            return $this->getDataOrganizationByCategory($categoryId,$allIdNews,0,10);
        }
    }

    function getStartDateEndDate() {
        $idsInDate = DB::select("
            SELECT id FROM news 
            WHERE (start_date <= ? AND end_date >= ?) OR start_date is null
            ", 
            [date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        return $idsInDate = (!empty($idsInDate)) ? array_column($idsInDate,'id') : [];
    
    }

    public function organizationBynewId(int $id)
    {
        $organizationId = NewsOrganization::select('organization_id')
            ->where('news_id',$id)
            ->get()->toArray();
        return (!empty($organizationId)) ? array_column($organizationId,'organization_id') : [];
    }

    public function deleteFileDownload($data,$id) {
        
        foreach($data as $value_file) {
            
            $this->news->where('id',$id)
            ->update([
                $value_file => null
            ]);
        }
       return;
    }
}