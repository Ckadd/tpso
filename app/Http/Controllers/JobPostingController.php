<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\JobPostingRepository;
use App\Repository\JobPostingViewRepository;
use App\Service\PaginateService;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\MappingLangRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\OrganizationRepository;
class JobPostingController extends VoyagerBaseController
{
    protected $themeService;
    protected $jobPostingRepository;
    protected $jobPostingViewRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $organizationRepository;

    public function __construct(
        ThemeService $themeService,
        JobPostingRepository $jobPostingRepository,
        JobPostingViewRepository $jobPostingViewRepository,
        AuditLogRepository $auditLogRepository,
        MappingLangRepository $mappingLangRepository,
        VisitorLogsRepository $visitorLogsRepository,
        OrganizationRepository $organizationRepository

    ) {
        $this->themeService             = $themeService;
        $this->jobPostingRepository     = $jobPostingRepository;
        $this->jobPostingViewRepository = $jobPostingViewRepository;
        $this->auditLogRepository       = $auditLogRepository;
        $this->visitorLogsRepository    = $visitorLogsRepository;
        $this->mappingLangRepository    = $mappingLangRepository;
        $this->organizationRepository   = $organizationRepository;
        
        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getIndex(Request $request)
    {
        $organization = $this->organizationRepository->listIdDot();
        if(!empty($organization)) {
            $organizationId = $organization[0]['id'];
            $alldata = $this->jobPostingRepository->getDataByOrganization($organizationId);
            $type    = 'view';
            $this->jobPostingViewRepository->addLogView($type,$organizationId);
            $data['logview'] = $this->jobPostingViewRepository->findLogViewByid($organizationId);
            if(!empty($alldata)) {
                
                $paginatedItems = PaginateService::getPaginate($alldata,7,$request);

                $data['alldata'] = $paginatedItems;

                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();

                return view('job-post',$data);
            }
        }
        

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('job-post');
    }

    public function downloadfile(int $id)
    {
        $pathById = $this->jobPostingRepository->listDataById($id);
        if(!empty($pathById[0]['file'])){
        $emploadePathRound1 = explode(':',$pathById[0]['file']);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);
        $path = storage_path('/app/public/'.$datareplece);
        
        return response()->download($path);
        }else {

            return back()->with('msg','ไม่มีไฟล์ให้ดาวน์โหลด');
        }
    }

    public function detail(int $id)
    {
        $dataById['alldata'] = $this->jobPostingRepository->listDetailById($id);
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('job-post-detail',$dataById);
    }

    public function organization(int $departmentId,Request $request)
    {
        $organization = $this->organizationRepository->listIdRelationDepartment($departmentId);
        
        if(!empty($organization)) {
            $organizationId = $organization[0]['id'];
            $alldata = $this->jobPostingRepository->getDataByOrganization($organizationId);
            $type    = 'view';
            $this->jobPostingViewRepository->addLogView($type,$organizationId);
            $data['logview'] = $this->jobPostingViewRepository->findLogViewByid($organizationId);
            
            if(!empty($alldata)) {
                
                $paginatedItems = PaginateService::getPaginate($alldata,7,$request);
                $data['alldata'] = $paginatedItems;
            }
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('job-post',$data);
        }
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
            $module = "JobPosting";
            
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
        if($request->file_del != null) {
            $data_file = explode(',',$request->file_del);
            $this->jobPostingRepository->deleteFileDownload($data_file,$id);
        }
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
            $module = "JobPosting";
            
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
            $module = "JobPosting";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $calendarDetail =  $this->mappingLangRepository->getTitleLastInsertJobPosting($request->title);
            $dataArr = array(
                'master_id'=> $calendarDetail->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'job-postings',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $calendarDetail =  $this->mappingLangRepository->getTitleLastInsertJobPosting($request->title);
            $dataArr = array(
                'master_id'=> $calendarDetail->id,
                'code_lang'=>$request->_lang,
                'module'=>'job-postings',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
