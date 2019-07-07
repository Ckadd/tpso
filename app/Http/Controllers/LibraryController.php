<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Repository\LibraryRepository;
use App\Repository\LibraryViewRepository;
use App\Service\ThemeService;
use Theme;
use Chencha\Share\ShareFacade;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\MappingLangRepository;

class LibraryController extends VoyagerBaseController
{
    protected $themeService;
    protected $libraryRepository;
    protected $libraryViewRepository;
    protected $mappingLangRepository;

    public function __construct(
        ThemeService $themeService,
        LibraryRepository $libraryRepository,
        LibraryViewRepository $libraryViewRepository,
        AuditLogRepository $auditLogRepository,
        MappingLangRepository $mappingLangRepository

    ) {
        $this->themeService = $themeService;
        $this->libraryRepository = $libraryRepository;
        $this->libraryViewRepository = $libraryViewRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->mappingLangRepository = $mappingLangRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    /**
     * add userid to library backend voyager.
     *
     * @param Request $request type request
     *
     * @return void \TCG\Voyager\Http\Controllers\VoyagerBaseController
     */
    // public function store(Request $request)
    // {
    //     $request->request->add(['create_by' => auth()->user()->id]);

    //     return parent::store($request);
    // }

    public function getIndex()
    {
        $alldata = $this->libraryRepository->findAllData();
        $allLogView = $this->libraryViewRepository->listAllLogView();

        $data['alldata'] = $alldata;
        $data['allLogView'] = $allLogView;

        return view('library',$data);
    }

    public function detail(int $id)
    {
        $type = "view";
        $this->libraryViewRepository->addLogView($id,$type);
        $data = $this->libraryRepository->findDataById($id);
        $logview = $this->libraryViewRepository->findLogViewByid($id);
        $logSocial = $this->libraryViewRepository->findLogSocialById($id);

        $data['detail'] = $data;
        $data['logview'] = $logview;
        $data['logAllSocial'] = $logSocial;
        
        return view('library-detail',$data);
    }

    public function sharefacebook(int $id) 
    {
        $type = 'facebook';
        $this->libraryViewRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/library/library-share-facebook/'.$id;
        $dataUrl = ShareFacade::load($url, 'library')->facebook();
        
        return redirect($dataUrl);
    }

    public function sharetwitter(int $id) 
    {
        $type = 'twitter';
        $this->libraryViewRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/library/library-share-twitter/'.$id;
        $dataUrl = ShareFacade::load($url, 'library')->twitter();
        
        return redirect($dataUrl);
    }

    public function sharegoogleplus(int $id) 
    {
        $type = 'googleplus';
        $this->libraryViewRepository->addLogBysocialPage($id,$type);
        $url='http://www.dot.go.th/library/library-share-googleplus/'.$id;
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
            $module = "Library";
            
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
            $module = "Library";
            
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
            $module = "Library";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertLibrarie($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'libraries',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertLibrarie($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'libraries',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
