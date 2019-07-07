<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\MissionStatementRepository;
use App\Repository\MissionStatementViewRepository;
use Chencha\Share\ShareFacade;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\VisitorLogsRepository;
use App\Repository\MappingLangRepository;

class MissionStatementController extends VoyagerBaseController
{
    protected $themeService;
    protected $missionStatementRepository;
    protected $missionStatementViewRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $mappingLangRepository;

    public function __construct(
        ThemeService $themeService,
        MissionStatementRepository $missionStatementRepository,
        MissionStatementViewRepository $missionStatementViewRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository,
        MappingLangRepository $mappingLangRepository


    ) {
        $this->themeService = $themeService;
        Theme::set($this->themeService->getCurrentTheme());
        $this->missionStatementRepository = $missionStatementRepository;
        $this->missionStatementViewRepository = $missionStatementViewRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->mappingLangRepository = $mappingLangRepository;

    }

    /**
     * add user id from backend voyager
     *
     * @param Request $request
     * @return void
     */
    // public function store(Request $request)
    // {
    //     $request->request->add(['create_by' => auth()->user()->id]);

    //     return parent::store($request);
    // }

    public function getindex()
    {
        // PaginateService::getPaginate();
        $alldata = $this->missionStatementRepository->listData();
        if(!empty($alldata)) { 
            $type = "view" ;
            $id = $alldata[0]['id'];
            $this->missionStatementViewRepository->addLogView($id,$type);
            
            $data['countView'] = $this->missionStatementViewRepository->findLogViewByid($id);
            $data['logSocial'] = $this->missionStatementViewRepository->listAllLogSocial($id);
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        $data['alldata'] = $alldata;
        
        return view('mission-statement',$data);
    }

    public function download(int $id)
    {
        $datapath = $this->missionStatementRepository->listfileById($id);
        $path = storage_path('/app/public/'.$datapath[0]);
        return response()->download($path);
    }

    public function sharefacebook(int $id) 
    {
        $type = 'facebook';
        $this->missionStatementViewRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/mission-statement/mission-statement-share-facebook/'.$id;
        $dataUrl = ShareFacade::load($url, 'library')->facebook();
        
        return redirect($dataUrl);
    }

    public function sharetwitter(int $id) 
    {
        $type = 'twitter';
        $this->missionStatementViewRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/mission-statement/mission-statement-share-twitter/'.$id;
        $dataUrl = ShareFacade::load($url, 'library')->twitter();
        
        return redirect($dataUrl);
    }

    public function sharegoogleplus(int $id) 
    {
        $type = 'googleplus';
        $this->missionStatementViewRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/mission-statement/mission-statement-share-googleplus/'.$id;
        $dataUrl = ShareFacade::load($url, 'library')->gplus();
        
        return redirect($dataUrl);
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
        $checkMaximun;
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
            $module = "MissionStatement";
            
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
            $this->missionStatementRepository->deleteFileDownload($data_file,$id);
        }
        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id);

        // check maximun title
        $checkMaximun;
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
            $module = "MissionStatement";
            
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
            $module = "MissionStatement";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertMissionStatement($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'mission-statements',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertMissionStatement($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'mission-statements',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }

}
