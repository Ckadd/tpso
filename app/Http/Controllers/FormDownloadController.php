<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\FormDownloadRepository;
use App\Repository\FormDownloadViewRepository;
use App\Service\PaginateService;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\OrganizationRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\FormdownloadCategoryRepository;
use App\Repository\MappingLangRepository;

class FormDownloadController extends VoyagerBaseController
{
    protected $themeService;
    protected $formDownloadRepository;
    protected $formDownloadViewRepository;
    protected $auditLogRepository;
    protected $organizationRepository;
    protected $visitorLogsRepository;
    protected $formdownloadRepository;
    protected $mappingLangRepository;

    public function __construct(
        ThemeService $themeService,
        FormDownloadRepository $formDownloadRepository,
        FormDownloadViewRepository $formDownloadViewRepository,
        AuditLogRepository $auditLogRepository,
        OrganizationRepository $organizationRepository,
        VisitorLogsRepository $visitorLogsRepository,
        FormdownloadCategoryRepository $formdownloadRepository,
        MappingLangRepository $mappingLangRepository

    ) {
        $this->themeService = $themeService;
        $this->formDownloadRepository = $formDownloadRepository;
        $this->formDownloadViewRepository = $formDownloadViewRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->organizationRepository = $organizationRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->formdownloadRepository = $formdownloadRepository;
        $this->mappingLangRepository = $mappingLangRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }


    public function getIndex(Request $request)
    {
        $checkIdOrganization = $this->organizationRepository->listIdDot();
        $paginatedItems = [];
        $logview = [];

        if(!empty($checkIdOrganization)) {
            $organizationId = $checkIdOrganization[0]['id'];

            // add and getLogview
            $logview = $this->addAndGetLogView($organizationId);
            $alldata = $this->formDownloadRepository->findAllData($organizationId);
            $paginatedItems = PaginateService::getPaginate($alldata,7,$request);
        }
        
        $data['logview'] = $logview;
        $data['alldata'] = $paginatedItems;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('form-download',$data);
    }

    public function downloadfile(int $id)
    {
        $pathById = $this->formDownloadRepository->listDataById($id);

        if(!empty($pathById[0]['file'])) {
            $emploadePathRound1 = explode(':',$pathById[0]['file']);
            $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
            $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
            $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
            $path = storage_path('/app/public/'.$datareplece);
            
            return response()->download($path);
        }else {

            return back()->with('msg','no file download');
        }
        
    }

    public function departmentId(int $id,Request $request)
    {
        
        $checkIdOrganization = $this->organizationRepository->listIdRelationDepartment($id);
        
        if(!empty($checkIdOrganization)) {
            $idDepartment = $checkIdOrganization[0]['id'];
            
            // add and getLogview
            $logview = $this->addAndGetLogView($idDepartment);
            $allData = $this->formDownloadRepository->listDataByDepartmentId($idDepartment);
            $paginatedItems = PaginateService::getPaginate($allData,7,$request);
            
            $data['alldata'] = $paginatedItems;
            $data['logview'] = $logview;
            return view('form-download',$data);
        }
    }

    public function detail(int $id)
    {
        $checkdata = $this->formDownloadRepository->listDetailDataById($id);
        if(!empty($checkdata)) {
            
            $data['alldata'] = $checkdata;
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('form-download-detail',$data);
        }
    } 

    public function departmentIdDownload(int $id,string $fileName) 
    {
       
        $queryData = $this->formDownloadRepository->listDetailDataById($id);
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

    public function Category(Request $request,int $id,int $idCategory) {
        
        $checkIdOrganization = $this->organizationRepository->listIdRelationDepartment($id);
        $checkStatusCategory = $this->formdownloadRepository ->checkStatus($idCategory);
        if(!empty($checkIdOrganization) && !empty($checkStatusCategory)) {
            $idDepartment = $checkIdOrganization[0]['id'];
            $allData = $this->formDownloadRepository->listCategoryDepartmentId($idDepartment,$idCategory);
            $paginatedItems = PaginateService::getPaginate($allData,7,$request);

            $data['alldata'] = $paginatedItems;
            
            return view('form-download',$data);
        }

        return view('form-download')->with('msg','No Data!!');
    }

    public function addAndGetLogView(int $organizationId) {
        
        $this->formDownloadViewRepository->addLogView('view',$organizationId);
        $logview = $this->formDownloadViewRepository->findLogViewByid($organizationId);
        return $logview;
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
            $module = "FormDownload";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);


            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            event(new BreadDataAdded($dataType, $data));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }
            $this-> addMappingLang($request);
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
            $this->formDownloadRepository->deleteFileDownload($data_file,$id);
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
            $module = "FormDownload";
            
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
            $module = "FormDownload";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertFormDownload($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'form-downloads',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertFormDownload($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'form-downloads',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
