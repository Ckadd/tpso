<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;
use App\Service\ThemeService;
use Theme;
use App\Repository\ContentSharingRepository;
use App\Repository\ContentSharingViewRepository;
use Chencha\Share\ShareFacade;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\MappingLangRepository;

class ContensharingController extends VoyagerBaseController
{
    protected $themeService;
    protected $contentSharingRepository;
    protected $contentSharingViewRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $mappingLangRepository;


    public function __construct(
        ThemeService $themeService,
        ContentSharingRepository $contentSharingRepository,
        ContentSharingViewRepository $contentSharingViewRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository,
        MappingLangRepository $mappingLangRepository

    ) {
        $this->themeService = $themeService;
        Theme::set($this->themeService->getCurrentTheme());
        $this->contentSharingRepository = $contentSharingRepository;
        $this->contentSharingViewRepository = $contentSharingViewRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->mappingLangRepository = $mappingLangRepository;

    }

    public function indexContent()
    {
        $dataContentById = $this->contentSharingRepository->listDataByOrder(1);
        $dataContentSort = $this->contentSharingRepository->listDataBySortOrder();
        $dataAllLogView['allViewLog']  = $this->contentSharingViewRepository->listAllLogView();
        $allshareLog  = $this->contentSharingViewRepository->listAllLogShare();

        $data['dataContentById'] = $dataContentById;
        $data['dataContentSort'] = $dataContentSort;
        $data['dataAllLogView'] = $dataAllLogView;
        $data['allshareLog'] = $allshareLog;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('content-sharing',$data);
    }

    public function contentDetail(int $id)
    {
        $this->contentSharingViewRepository->addlogByViewPage($id);
        $dataContentById = $this->contentSharingRepository->listDataById($id);
        $data['dataAllSocial'] = $this->contentSharingViewRepository->listAllLogById($id);
        $data['dataContentById'] = $dataContentById;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot('content-sharing-detail');

        return view('content-sharing-detail',$data);
    }

    public function sharesocial(int $id)
    {
        $type = 'facebook';
        $this->contentSharingViewRepository->addlogByShareSocialPage($id,$type);
        $url='http://www.dot.go.th/content-sharing/content-sharing-detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'Content Sharing')->facebook();
        
        return redirect($dataUrl);
    }

    public function sharetwitter(int $id)
    {
        $type = 'twitter';
        $this->contentSharingViewRepository->addlogByShareSocialPage($id,$type);
        $url='http://www.dot.go.th/content-sharing/content-sharing-detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'Content Sharing')->twitter();
        
        return redirect($dataUrl);
    }

    public function sharegoogleplus(int $id)
    {
        $type = 'googleplus';
        $this->contentSharingViewRepository->addlogByShareSocialPage($id,$type);
        $url='http://www.dot.go.th/content-sharing/content-sharing-detail/'.$id;
        $dataUrl = ShareFacade::load($url, 'Content Sharing')->gplus();
        
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
        $request->request->add(['create_by' => auth()->user()->id]);
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        // check maximun title and shortdescription
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
            $module = "Content-Sharing";
            
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
            $module = "Content-Sharing";
            
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
            $module = "Content-Sharing";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertContentSharing($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'content-sharings',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertContentSharing($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'content-sharings',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
