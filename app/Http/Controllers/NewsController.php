<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Database\Schema\SchemaManager;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use UserService;
use NewsConstant;
// use Voyager;
use App\Repository\NewsCategoryRepository;
use App\Service\ThemeService;
use Theme;
use Chencha\Share\ShareFacade;
use App\Service\PaginateService;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use App\Repository\MappingLangRepository;
use App\Repository\NewsManageRelateRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\OrganizationRepository;
use App\Repository\DepartmentMenuRepository;
use App\Repository\NewletterSubScribeRepository;
use Illuminate\Support\Facades\Storage;

class NewsController extends VoyagerBaseController
{
    protected $newCategoryRepository;
    protected $themeService;
    protected $auditLogRepository;
    protected $mappingLangRepository;
    protected $newsManageRelateRepository;
    protected $visitorLogsRepository;
    protected $organizationRepository;
    protected $departmentMenuRepository;
    protected $newletterSubScribeRepository;

    public function __construct(
        NewsCategoryRepository $newCategoryRepository,
        ThemeService $themeService,
        AuditLogRepository $auditLogRepository,
        NewsManageRelateRepository $newsManageRelateRepository,
        VisitorLogsRepository $visitorLogsRepository,
        OrganizationRepository $organizationRepository,
        DepartmentMenuRepository $departmentMenuRepository,
        MappingLangRepository $mappingLangRepository,
        NewletterSubScribeRepository $newletterSubScribeRepository
    )
    {
        $this->newCategoryRepository = $newCategoryRepository;
        $this->themeService = $themeService;
        $this->auditLogRepository = $auditLogRepository;
        $this->mappingLangRepository = $mappingLangRepository;
        $this->newsManageRelateRepository = $newsManageRelateRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->organizationRepository = $organizationRepository;
        $this->departmentMenuRepository = $departmentMenuRepository;
        $this->newletterSubScribeRepository = $newletterSubScribeRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    // *** menu inform ***
    public function pressReleases(Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataPressReleases();
        // $paginatedItems = PaginateService::getPaginate($listdata,5,$request);
        
        $data['alldata'] = $listdata;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-inform',$data);
    }

    public function pressReleasesDetail(int $id)
    {
        $this->newCategoryRepository->addLogView($id,'view');
        $queryData = $this->newCategoryRepository->listDataPressReleasesById($id);

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-inform-detail',$queryData);
    }

    public function informsharefacebook(int $id) 
    {
        $type = 'facebook';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/inform/detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-inform')->facebook();
        
        return redirect($dataUrl);
    }

    public function informsharetwitter(int $id) 
    {
        $type = 'twitter';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/inform/detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-inform')->twitter();
        
        return redirect($dataUrl);
    }

    public function informsharegoogleplus(int $id) 
    {
        $type = 'googleplus';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/inform/detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-inform')->gplus();
        
        return redirect($dataUrl);
    }

    public function informDetailDownload(int $id,string $fileName) 
    {
        $queryData = $this->newCategoryRepository->listDataPressReleasesById($id);
        
        $dataFile = $queryData['alldata'][$fileName];
        
        $emploadePathRound1 = explode(':',$dataFile);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->file($path);

    }

    public function informDepartmentId(int $id,Request $request)
    {
        //id = organization
        $listdata = $this->newCategoryRepository->listDataInformByOrganization($id);
        // $paginatedItems = PaginateService::getPaginate($listdata,5,$request);
        
        $data['alldata'] = $listdata;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-inform',$data);
    }

    // *** menu institution ***
    public function institution(Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataInstitution();
        
        // $paginatedItems = PaginateService::getPaginate($listdata,7,$request);
        
        $queryData['data'] = $listdata;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-institution',$queryData);
    }

    public function institutionDetail(int $id)
    {
        $this->newCategoryRepository->addLogView($id,'view');
        $queryData = $this->newCategoryRepository->listDataInstitutionById($id);

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-institution-detail',$queryData);
    }

    public function downloadinstitution(int $id)
    {
        $data = $this->newCategoryRepository->listDataInstitutionById($id);
        
        if(empty($data['alldata']['file1'])) {

            return back()->with('msg','ไม่มีไฟล์ข้อมูล กรุณา import file!!');
        }

        $emploadePathRound1 = explode(':',$data['alldata']['file1']);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->file($path);
        // return response()->download($path);
    }

    public function institutionDetailDownload(int $id,string $fileName) 
    {
        $queryData = $this->newCategoryRepository->listDataInstitutionById($id);
        
        $dataFile = $queryData['alldata'][$fileName];
        
        $emploadePathRound1 = explode(':',$dataFile);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->file($path);

    }

    public function institutionDepartmentId(int $id,Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataInstitutionByOrganization($id);
        // $paginatedItems = PaginateService::getPaginate($listdata,7,$request);
        
        $queryData['data'] = $listdata;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-institution',$queryData);
    }
    
    // *** menu manager ***
    public function manager(Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataManager();
        
        // $paginatedItems = PaginateService::getPaginate($listdata,5,$request);


        $data['alldata'] = $listdata;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-manager',$data);
    }

    public function managerDetail(int $id)
    {
        $this->newCategoryRepository->addLogView($id,'view');
        $newRelated = $this->newsManageRelateRepository->listRelatedByManageId($id);
        $queryData = $this->newCategoryRepository->listDataManagerById($id);

        $queryData['newRelated'] = $newRelated;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-manager-detail',$queryData);
    }

    public function managersharefacebook(int $id) 
    {
        $type = 'facebook';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/manager/detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-manager')->facebook();
        
        return redirect($dataUrl);
    }

    public function managersharetwitter(int $id) 
    {
        $type = 'twitter';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/manager/detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-manager')->twitter();
        
        return redirect($dataUrl);
    }

    public function managersharegoogleplus(int $id) 
    {
        $type = 'googleplus';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/manager/detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-manager')->gplus();
        
        return redirect($dataUrl);
    }
    public function managerDetailDownload(int $id,string $fileName) 
    {
        $queryData = $this->newCategoryRepository->listDataInstitutionById($id);

        $dataFile = $queryData['alldata'][0][$fileName];
        
        $emploadePathRound1 = explode(':',$dataFile);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->file($path);

    }

    public function managerDepartmentId(int $id,Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataManagerByOrganization($id);
        
        // $paginatedItems = PaginateService::getPaginate($listdata,5,$request);


        $data['alldata'] = $listdata;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-manager',$data);
    }
    

    // *** menu procurement ***
    public function procurement(Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataProcurement();
        
        // $paginatedItems = PaginateService::getPaginate($listdata,8,$request);

        $data['alldata'] = $listdata;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-procurement',$data);
    }

    public function procurementDetail(int $id)
    {
        $this->newCategoryRepository->addLogView($id,'view');
        $queryData = $this->newCategoryRepository->listDataProcurementById($id);

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-procurement-preview',$queryData);
    }

    public function procurementDetailDownload(int $id,string $fileName) 
    {
        $queryData = $this->newCategoryRepository->listDataProcurementById($id);
        
        $dataFile = $queryData['alldata'][$fileName];
        
        $emploadePathRound1 = explode(':',$dataFile);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->file($path);

    }

    public function procurementdownload(int $id)
    {
        $queryData = $this->newCategoryRepository->listDataProcurementById($id);
        if(empty($queryData['alldata']['file1'])) {
            
            return back()->with('msg','ไม่มีไฟล์ข้อมูล กรุณา import file!!');
        }

        $emploadePathRound1 = explode(':',$queryData['alldata']['file1']);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->file($path);
    }
    public function procurementsharefacebook(int $id) 
    {
        $type = 'facebook';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/procurement-detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-procurement')->facebook();
        
        return redirect($dataUrl);
    }

    public function procurementsharetwitter(int $id) 
    {
        $type = 'twitter';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/procurement-detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-procurement')->twitter();
        
        return redirect($dataUrl);
    }

    public function procurementsharegoogleplus(int $id) 
    {
        $type = 'googleplus';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/procurement-detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'news-procurement')->gplus();
        
        return redirect($dataUrl);
    }

    public function guide(Request $request)
    {
        $listdata = $this->newCategoryRepository->listDataGuide();
        
        // $paginatedItems = PaginateService::getPaginate($listdata,7,$request);
        
        $queryData['data'] = $listdata;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-guide',$queryData);
    }

    public function guideDetail(int $id)
    {
        $this->newCategoryRepository->addLogView($id,'view');
        $queryData = $this->newCategoryRepository->listDataInstitutionById($id);

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-guide-detail',$queryData);
    }

    public function downloadGuideFirstFile(int $id)
    {
        $data = $this->newCategoryRepository->listDataInstitutionById($id);
        
        if(empty($data['alldata']['file1'])) {

            return back()->with('msg','ไม่มีไฟล์ข้อมูล กรุณา import file!!');
        }

        $pathDecode = json_decode($data['alldata']['file1']);
        $path = storage_path('/app/public/'.$pathDecode[0]->download_link);
        
        return response()->file($path);
    }

    public function guideDetailDownload(int $id,string $fileName) 
    {
        $queryData = $this->newCategoryRepository->listDataInstitutionById($id);
        
        $pathDecode = json_decode($queryData['alldata'][$fileName]);
        $path = storage_path('/app/public/'.$pathDecode[0]->download_link);
        
        return response()->file($path);

    }

    /**
     * detail another form to department
     *
     * @param integer $id
     * @return void
     */
    public function anotherDetail(int $id)
    {
        $this->newCategoryRepository->addLogView($id,'view');
        $queryData = $this->newCategoryRepository->listdataDetailAnother($id);
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-another-detail',$queryData);
    }

    /**
     * download another form to department
     *
     * @param integer $id
     * @return void
     */
    public function anotherDownload(int $id)
    {
        $queryData = $this->newCategoryRepository->listdataDetailAnother($id);
        
        if(empty($queryData['alldata']['file1'])) {
            
            return back()->with('msg','ไม่มีไฟล์ข้อมูล กรุณา import file!!');
        }

        $download_file = json_decode($queryData['alldata']['file1']);
        $download_file = $download_file[0]->download_link;
        
        if (Storage::disk(config('voyager.storage.disk'))->exists($download_file)) {
            return Storage::disk(config('voyager.storage.disk'))->download($download_file);
        }

        return back()->with('msg','ไม่มีไฟล์ในฐานข้อมูล');
    }

    public function another(Request $request,int $organizationId, int $categoryId)
    {
        $listdata = $this->newCategoryRepository->listDataAnother($organizationId,$categoryId);
        // $paginatedItems = PaginateService::getPaginate($listdata,7,$request);
        $title = $this->newCategoryRepository->listCategoryId($categoryId);
        
        $queryData['data'] = $listdata;
        $queryData['title'] = $title;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('news-another',$queryData);
    }

    /**
     * internalAuditPlan
     *
     * @param integer $id
     * @param request $request
     * @return void
     */
    public function internalAuditPlan(Request $request,int $id,int $cagegoryId)
    {
        $dataOrganization = $this->organizationRepository->listIdRelationDepartment($id);
        $dataCategory     = $this->newCategoryRepository->listCategoryId($cagegoryId);
        
        // check data organization and new-category
        if(!empty($dataOrganization) && !empty($dataCategory)) {
            $organizationId = $dataOrganization[0]['id'];
            $categoryId     = $dataCategory[0]['id'];

            $news = $this->newCategoryRepository->listInternalAuditPlan($organizationId,$categoryId);
            $dataMenu =$this->departmentMenuRepository->listMenuByDepartmentId($id);
            
            // $paginatedItems = PaginateService::getPaginate($news,4,$request);
            
            $data['allData'] = $news;
            $data['menu']    = $dataMenu;
            $data['category'] = $dataCategory;

            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('news-internal-audit-plan',$data);
        }else {

            return redirect()->with('msg','no data');
        }
        
    }

    public function internalDetail(int $id,int $idCategory)
    {
        
        $news = $this->newCategoryRepository->findNewById($id);
        $category = $this->newCategoryRepository->findCategoryById($idCategory);
        
        // add log view
        $this->newCategoryRepository->addLogView($id,'view');

        if(!empty($news) && !empty($category)) {
            $data['alldata'] = $news[0];
            $data['category'] = $category[0];
            $data['view'] = $this->newCategoryRepository->listViewById($id);
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('news-internal-audit-detail',$data);
        }

        return view('news-internal-audit-detail');
    }

    public function internalDetailsharefacebook(int $id,int $idCategory) 
    {
        $type = 'facebook';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/internal-audit-plan/detail/'.$id.'/'.$idCategory;
        $dataUrl = ShareFacade::load($url, 'news-internal-audit-plant')->facebook();
        
        return redirect($dataUrl);
    }

    public function internalDetailsharetwitter(int $id,int $idCategory) 
    {
        $type = 'twitter';
        $this->newCategoryRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/news/internal-audit-plan/detail/'.$id.'/'.$idCategory;
        $dataUrl = ShareFacade::load($url, 'news-internal-audit-plant')->twitter();
        
        return redirect($dataUrl);
    }

    // add auditLog

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        // check maximun title and shortdescription
        (setting('admin.maximun_title') != "")? $checkMaximun = setting('admin.maximun_title') : $checkMaximun = 0; 
        (setting('admin.maximun_shortDescription') != "")? $maximunShortDescription = setting('admin.maximun_shortDescription') : $maximunShortDescription = 0;
        
        $titleLength = strlen($request->title);
        $shortDescription = strlen($request->short_description);
        if($titleLength > $checkMaximun) {
            return back()->with('max-length','title length is maximun');
        }else if($shortDescription > $maximunShortDescription) {
            return back()->with('max-length','shortDescription length is maximun');
        }

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->has('_validate')) {

            /**
             * add auditLog
             * @param userid $userId @param action $actions @param module $module
             */
            $userName = auth()->user()->name;
            $actions = "create";
            $module = "News";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);
            
            

            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
            
            if(!empty($data) && !empty($request['category_id']) && !empty($request['news_belongsto_organization_relationship'])) {
                $dataNew = $data->toArray();
                $categoryId = $request['category_id'];
                $organizationId = $request['news_belongsto_organization_relationship'];
                $this->newletterSubScribeRepository->sendMailNews($categoryId,$organizationId,$dataNew);
            }
            
            event(new BreadDataAdded($dataType, $data));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }
            $this->addMappingLang($request);

            // clone some column ex. image, file by master_id if exists
            $this->mappingLangRepository->deplicateNotExistsField($request, $data->id, $dataType);

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                        'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                        'alert-type' => 'success',
                    ]);
        }
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        
        if($request->file_del != null) {
            $data_file = explode(',',$request->file_del);
            $this->newCategoryRepository->deleteFileDownload($data_file,$id);
        }
        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id);

        // check maximun title and shortdescription
        (setting('admin.maximun_title') != "")? $checkMaximun = setting('admin.maximun_title') : $checkMaximun = 0; 
        (setting('admin.maximun_shortDescription') != "")? $maximunShortDescription = setting('admin.maximun_shortDescription') : $maximunShortDescription = 0;
        
        $titleLength = strlen($request->title);
        $shortDescription = strlen($request->short_description);
        if($titleLength > $checkMaximun) {
            return back()->with('max-length','title length is maximun');
        }else if($shortDescription > $maximunShortDescription) {
            return back()->with('max-length','shortDescription length is maximun');
        }

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {

            /**
             * add auditLog
             * @param userid $userId @param action $actions @param module $module
             */
            $userName = auth()->user()->name;
            $actions = "update";
            $module = "News";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

            event(new BreadDataUpdated($dataType, $data));

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }
    
    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

            /**
             * add view auditLog
             * @param userid $userId @param action $actions @param module $module
             */
            $userName = auth()->user()->name;
            $actions = "view";
            $module = "News";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $new =  $this->mappingLangRepository->getSlugLastInsertNew($request->title);
            $dataArr = array(
                'master_id'=> $new->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'news',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $new =  $this->mappingLangRepository->getSlugLastInsertNew($request->title);
            $dataArr = array(
                'master_id'=> $new->id,
                'code_lang'=>$request->_lang,
                'module'=>'news',
                'created_at'=>date('Y-m-d H:i:s'));
        }

        $this->mappingLangRepository->add($dataArr);
    }
}
