<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ThemeService;
use Theme;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Repository\DepartmentRepository;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\GalleryCategoryRepository;
use App\Repository\OrganizationRepository;
use App\Repository\NewsCategoryRepository;
use App\Repository\BannerRepository;
use App\Repository\ServiceListRepository;
use App\Repository\DepartmentMenuRepository;
use App\Repository\CalendarDetailRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\MappingLangRepository;

class DepartmentController extends VoyagerBaseController
{
    protected $themeService;
    protected $departmentRepository;
    protected $auditLogRepository;
    protected $galleryCategoryRepository;
    protected $organizationRepository;
    protected $newCategoryRepository;
    protected $bannerRepository;
    protected $serviceListRepository;
    protected $departmentMenuRepository;
    protected $calendarDetailRepository;
    protected $visitorLogsRepository;
    protected $mappingLangRepository;


    public function __construct(
        ThemeService $themeService,
        DepartmentRepository $departmentRepository,
        AuditLogRepository $auditLogRepository,
        GalleryCategoryRepository $galleryCategoryRepository,
        OrganizationRepository $organizationRepository,
        NewsCategoryRepository $newCategoryRepository,
        BannerRepository $bannerRepository,
        ServiceListRepository $serviceListRepository,
        DepartmentMenuRepository $departmentMenuRepository,
        CalendarDetailRepository $calendarDetailRepository,
        VisitorLogsRepository $visitorLogsRepository,
        MappingLangRepository $mappingLangRepository
    )
    {
        $this->themeService = $themeService;
        $this->departmentRepository = $departmentRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->galleryCategoryRepository = $galleryCategoryRepository;
        $this->organizationRepository = $organizationRepository;
        $this->newCategoryRepository = $newCategoryRepository;
        $this->bannerRepository = $bannerRepository;
        $this->serviceListRepository = $serviceListRepository;
        $this->departmentMenuRepository = $departmentMenuRepository;
        $this->calendarDetailRepository = $calendarDetailRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->mappingLangRepository = $mappingLangRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getIndex()
    {
        $queryData = $this->departmentRepository->getDepartment();
        $data['department'] = $queryData;
       
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('internal-department.index',$data);
    }

    public function getDepartmentId(int $id)
    {
        $queryData = $this->departmentRepository->getDepartmentById($id);
        
        if(!empty($queryData)) {
            if($queryData[0]['visible'] == 1) {
                $data['department'] = $queryData;
                
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();

                return view('internal-department.index',$data);
            }else {

                return redirect()->action('DepartmentController@getIndexMaster',['id'=>$id]);
            }
        }else {

            return redirect('/'); 
        }
    }

    public function getIndexMaster(int $id)
    {
        
        $idOrganization = $this->organizationRepository->listIdRelationDepartment($id);
        
        if(!empty($idOrganization)) {
            
            $gallery = $this->galleryCategoryRepository->listCategoryDepartment($idOrganization[0]['id']);
            $newPressRelease = $this->newCategoryRepository->NewPressReleasesByDepartmentId($idOrganization[0]['id']);
            $newManage = $this->newCategoryRepository->NewManageByDepartmentId($idOrganization[0]['id']);
            //$newActivity = $this->newCategoryRepository->NewActivitiesByDepartmentId($idOrganization[0]['id']);
            $newAnnounce = $this->newCategoryRepository->NewAnnounceByDepartmentId($idOrganization[0]['id']);
            $data = $this->bannerRepository->listDataByOrganizationId($idOrganization[0]['id']);
            $service = $this->serviceListRepository->listServiceByOrganizationId($idOrganization[0]['id']);
            $menu = $this->departmentMenuRepository->listMenuByDepartmentId($id);
            $calendarDetail = $this->calendarDetailRepository->listDataByOrganizationId($idOrganization[0]['id']);
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            $data['gallery'] = $gallery;
            $data['newPressRelease'] = $newPressRelease;
            $data['newManage'] = $newManage;
            $data['newActivity'] = $calendarDetail;
            $data['announce'] = $newAnnounce;
            $data['service'] = $service;
            $data['menu'] = $menu;
            $data['idDepartMent'] = $idOrganization[0]['id'];
            
            return view('internal-department.masterindex',$data);
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('internal-department.masterindex');
    }

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
        $request->request->add(['create_by' => auth()->user()->id]);
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
            $module = "Department";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);


            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

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
            $module = "Department";
            
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
             * delete auditLog
             * @param userid $userId @param action $actions @param module $module
             */
            $userName = auth()->user()->name;
            $actions = "view";
            $module = "Department";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertDepartment($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'departments',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertDepartment($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'departments',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }

}
