<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\LawRegulationRepository;
use App\Repository\LawRegulationCategoryRepository;
use App\Repository\LawRegulationViewRepository;
use App\Service\PaginateService;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\VisitorLogsRepository;
use App\Repository\OrganizationRepository;
use App\Repository\MappingLangRepository;

class LawRegulationController extends VoyagerBaseController
{
    protected $themeService;
    protected $lawRegulationRepository;
    protected $lawRegulationCategoryRepository;
    protected $lawRegulationViewRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $organizationRepository;
    protected $mappingLangRepository;

    public function __construct(
        ThemeService $themeService,
        LawRegulationRepository $lawRegulationRepository,
        LawRegulationCategoryRepository $lawRegulationCategoryRepository,
        LawRegulationViewRepository $lawRegulationViewRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository,
        OrganizationRepository $organizationRepository,
        MappingLangRepository $mappingLangRepository

    ) {
        $this->themeService = $themeService;
        $this->lawRegulationRepository = $lawRegulationRepository;
        $this->lawRegulationCategoryRepository = $lawRegulationCategoryRepository;
        $this->lawRegulationViewRepository = $lawRegulationViewRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->organizationRepository = $organizationRepository;
        $this->mappingLangRepository = $mappingLangRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getindextravel(Request $request)
    {
        $type = 'view';
        $checkIdOrganization = $this->organizationRepository->listIdDot();
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawTravel();
        
        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
            
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);
            
            // $valueConvert = json_decode(json_encode($dataTravel,true));
            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('law-regulation',$data);
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('law-regulation');
    }

    public function getindexdecree(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawDecree();
        $checkIdOrganization = $this->organizationRepository->listIdDot();

        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
            
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);
            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation',$data);
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('law-regulation');
    }

    public function getindexministerial(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawministerial();
        $checkIdOrganization = $this->organizationRepository->listIdDot();

        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);

            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);
            
            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('law-regulation',$data);
        }
        
        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();
        
        return view('law-regulation');
    }

    public function getindexruleoftravel(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawruleoftravel();
        $checkIdOrganization = $this->organizationRepository->listIdDot();

        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);

            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();
            
            return view('law-regulation',$data);
        }

        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();

        return view('law-regulation');
    }

    public function getindexconstitution(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawconstitution();
        $checkIdOrganization = $this->organizationRepository->listIdDot();

        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);

            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation',$data);
        }

        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();
  
        return view('law-regulation');
    }

    public function getindexact(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawact();
        $checkIdOrganization = $this->organizationRepository->listIdDot();
        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);

            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();
            
            return view('law-regulation',$data);
        }
        
        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();

        return view('law-regulation');
    }

    public function getindexordinance(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawordinance();
        $checkIdOrganization = $this->organizationRepository->listIdDot();
        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);
            
            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation',$data);
        }

        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();

        return view('law-regulation');
    }

    public function getindexregularity(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawregularity();
        $checkIdOrganization = $this->organizationRepository->listIdDot();

        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);

            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation',$data);
        }

        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();

        return view('law-regulation');
    }

    public function getindexannounce(Request $request)
    {
        $type = 'view';
        $dataCategory = $this->lawRegulationCategoryRepository->listDataLawannounce();
        $checkIdOrganization = $this->organizationRepository->listIdDot();
        if(!empty($dataCategory) && !empty($checkIdOrganization)) {
            $id = $dataCategory[0]['id'];
            $organizationId = $checkIdOrganization[0]['id'];
            $this->lawRegulationViewRepository->addLogBysocialPage($id, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($id);
        
            // get data status 1
            $dataTravel = $this->getStatus($dataCategory[0]['lawregulations'],$organizationId);
            
            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation',$data);
        }
        
        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();
        
        return view('law-regulation');
    }

    public function download(int $id,string $type)
    {
        $pathById = $this->lawRegulationRepository->downloadFileByCategoryId($id, $type);
        
        if(!empty($pathById['file'])) {
            
            $emploadePathRound1 = explode(':',$pathById['file']);
            $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
            $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
            $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
            $path = storage_path('/app/public/'.$datareplece);
        
            return response()->download($path);
        }else {

            return back()->with('msg','no file download!!');
        }
    }

    public function detail(int $id)
    {
        $allData = $this->lawRegulationRepository->findDataById($id);

        if(!empty($allData)) {

            $data['alldata'] = $allData;
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation-detail',$data);
        }else {

            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();
            
            return redirect('/law-Regulation/travel')->with('msg','ไม่มีข้อมูล');
        }
    }

    public function downloadFile(int $id,string $fileName) 
    {
       
        $queryData = $this->lawRegulationRepository->findDataById($id);
        
        if(!empty($queryData)) {

            $dataFile = $queryData[0][$fileName];
            
            $emploadePathRound1 = explode(':',$dataFile);
            $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
            $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
            $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
            $path = storage_path('/app/public/'.$datareplece);
            
            return response()->file($path);
        }else {

            return back()->with('msg','no file download!!');
        }

    }

    public function department(Request $request,int $id,int $idCategory)
    {
        
        $type = 'view';
        $checkIdOrganization = $this->organizationRepository->listIdRelationDepartment($id);
        $dataCategory = $this->lawRegulationCategoryRepository->listCategoryById($idCategory);
        
        if(!empty($checkIdOrganization) && !empty($dataCategory)) {
            $organizationId = $checkIdOrganization[0]['id'];
            
            $this->lawRegulationViewRepository->addLogBysocialPage($idCategory, $type);
            $logView = $this->lawRegulationViewRepository->findLogViewByid($idCategory);
            
            // get data status 1
            $dataTravel = $this->lawRegulationRepository->listDepartmentId($organizationId,$idCategory);
            
            $paginatedItems = PaginateService::getPaginate($dataTravel,7,$request);

            $data['allTravel'] = $paginatedItems;
            $data['logView'] = $logView;
            $data['dataMain'] = $dataCategory[0];
            
            /**
            * log visitWebsite
            */
            $this->visitorLogsRepository->addLogDot();

            return view('law-regulation',$data);
        }

        /**
        * log visitWebsite
        */
        $this->visitorLogsRepository->addLogDot();
        
        return view('law-regulation');
    }

    /**
     * get data status 1
     *
     * @param array $data
     * @return void
     */
    function getStatus(array $data,int $id) {
        $newData = [];
        
        foreach($data as $key => $val) { 
            if($val['status'] == 1 && $val['organization_id'] == $id) {
                $newData[] = $val;
            }
        }

        return $newData;
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

        // check maximun title
        (setting('admin.maximun_title') != "")? $checkMaximun = setting('admin.maximun_title') : $checkMaximun = 0; 
        $titleLength = strlen($request->title);
        
        if($titleLength > $checkMaximun) {
            return back()->with('max-length','title length is maximun');
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
            $module = "LawRegulation";
            
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

        // check maximun title
        (setting('admin.maximun_title') != "")? $checkMaximun = setting('admin.maximun_title') : $checkMaximun = 0; 
        $titleLength = strlen($request->title);
        
        if($titleLength > $checkMaximun) {
            return back()->with('max-length','title length is maximun');
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
            $module = "LawRegulation";
            
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
            $module = "LawRegulation";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertLawsRegulation($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'laws-regulations',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertLawsRegulation($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'laws-regulations',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
