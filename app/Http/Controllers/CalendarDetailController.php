<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\CalendarDetailRepository;
use App\Repository\CalendarCategoryRepository;
use Illuminate\Support\Facades\DB;
use App\Service\PaginateService;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\MappingLangRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\OrganizationRepository;
class CalendarDetailController extends VoyagerBaseController
{
    protected $themeService;
    protected $calendarDetailRepository;
    protected $calendarCategoryRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $organizationRepository;

    public function __construct(
        ThemeService $themeService,
        CalendarDetailRepository $calendarDetailRepository,
        CalendarCategoryRepository $calendarCategoryRepository,
        AuditLogRepository $auditLogRepository,
        MappingLangRepository $mappingLangRepository,
        VisitorLogsRepository $visitorLogsRepository,
        OrganizationRepository $organizationRepository

    )
    {
        $this->themeService = $themeService;
        $this->calendarDetailRepository = $calendarDetailRepository;
        $this->calendarCategoryRepository = $calendarCategoryRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->mappingLangRepository = $mappingLangRepository;
        $this->organizationRepository = $organizationRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getindex(Request $request)
    {
        $checkOrganization = $this->organizationRepository->listIdDot();
        $calendarCategory = $this->calendarCategoryRepository->listCategory();
        $month = $this->calendarCategoryRepository->listMonth();
        $date = [];
        $paginatedItems = [];
        if(!empty($checkOrganization)) {
            $organizationId = $checkOrganization[0]['id'];
            $alldata = $this->calendarDetailRepository->listAllDataByOrganization($organizationId);
            $fullContent = $alldata;
            $dataOrder1 = '';

            if (count($alldata) > 0) {
                $dataOrder1 = $alldata[0];
                $paginatedItems = PaginateService::getPaginate($alldata, 6, $request);

                // get DateTime from order1
                $date = $this->getDateTime($dataOrder1['datetime']);
            }
        }

        $data['alldata'] = $paginatedItems;
        $data['order1'] = $dataOrder1;
        $data['category'] = $calendarCategory;
        $data['month'] = $month;
        $data['fullContent'] = $fullContent;
        $data['dateFirst'] = $date;
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('calendar',$data);
    }

    public function detail(int $id)
    {
        $dataById = $this->calendarDetailRepository->getDataById($id);
        
        $data['dataById'] = $dataById;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('calendar-detail',$data);
    }

    public function search(Request $request) 
    {
        $request = $request->all();

        $nameMonth = [
            1 => 'January', 
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        // search category only
        if(!empty($request['category']) && empty($request['month'])) {
            $idCategory = $this->calendarCategoryRepository->listCategoryById($request['category']);
            $alldata = $this->calendarDetailRepository->listDataById($idCategory);
            
            // select month and category
            $calendarCategory = $this->calendarCategoryRepository->listCategory();
            $month = $this->calendarCategoryRepository->listMonth();

            $fullContent = $alldata;
            
            if(empty($alldata)) { 
                $data['category'] = $calendarCategory;
                $data['month'] = $month;
                $data['alldata'] = $alldata;

                return view('calendar',$data);
            }

            (COUNT($alldata) > 1) ? $dataOrder1 = $alldata[0] : $dataOrder1 = [];

            // get DateTime from order1
            $date = $this->getDateTime($dataOrder1['datetime']);
            $request = new Request();
            $paginatedItems = PaginateService::getPaginate($alldata,6,$request);

            $data['alldata'] = $paginatedItems;
            $data['order1'] = $dataOrder1;
            $data['category'] = $calendarCategory;
            $data['month'] = $month;
            $data['fullContent'] = $fullContent;
            $data['dateFirst'] = $date;

            return view('calendar',$data);

        // search month only
        }else if(!empty($request['month']) && empty($request['category'])) {

            $requestMonth = $request['month'];
            $idMonth = array_search($requestMonth,$nameMonth);
            $calendarBySearch = $this->calendarDetailRepository->listDataByMonth($idMonth);
            // select month and category
            $calendarCategory = $this->calendarCategoryRepository->listCategory();
            $month = $this->calendarCategoryRepository->listMonth();
            $alldata = json_decode(json_encode($calendarBySearch),true);
            $fullContent = $alldata;
        
            if(empty($alldata)) { 
                $data['category'] = $calendarCategory;
                $data['month'] = $month;
                $data['alldata'] = $alldata;

                return view('calendar',$data);
            }
           
            $dataOrder1 = $alldata[0];
            // get DateTime from order1
            $date = $this->getDateTime($dataOrder1['datetime']);
            $request = new Request();
            $paginatedItems = PaginateService::getPaginate($alldata,6,$request);

            $data['alldata'] = $paginatedItems;
            $data['order1'] = $dataOrder1;
            $data['category'] = $calendarCategory;
            $data['month'] = $month;
            $data['fullContent'] = $fullContent;
            $data['dateFirst'] = $date;

            return view('calendar',$data);

        }elseif(!empty($request['month']) && !empty($request['category'])) {
            $requestMonth = $request['month'];
            $idMonth = array_search($requestMonth,$nameMonth);
            $idCategory = $this->calendarCategoryRepository->listCategoryById($request['category']);
            $calendarBySearch = $this->calendarDetailRepository->listDataIdAndMonth($idCategory,$idMonth);
            // category and month
            $calendarCategory = $this->calendarCategoryRepository->listCategory();
            $month = $this->calendarCategoryRepository->listMonth();
            $alldata = json_decode(json_encode($calendarBySearch),true);
            $fullContent = $alldata;

            if(empty($alldata)) {
                $data['category'] = $calendarCategory;
                $data['month'] = $month;
                $data['alldata'] = $alldata;

                return view('calendar',$data);
            }

            (COUNT($alldata) > 1) ? $dataOrder1 = $alldata[0] : $dataOrder1 = [];
            // get DateTime from order1
            $date = $this->getDateTime($dataOrder1['datetime']);
            $request = new Request();
            $paginatedItems = PaginateService::getPaginate($alldata,6,$request);
            
            $data['alldata'] = $paginatedItems;
            $data['order1'] = $dataOrder1;
            $data['category'] = $calendarCategory;
            $data['month'] = $month;
            $data['fullContent'] = $fullContent;
            $data['dateFirst'] = $date;

            return view('calendar',$data);

        }else {

            return redirect()->action('CalendarDetailController@getindex');
        }
    }

    public function listDataByDepartment(int $id,Request $request) {
        $alldata = $this->calendarDetailRepository->listAllDataByOrganization($id);
        $calendarCategory = $this->calendarCategoryRepository->listCategory();
        $month = $this->calendarCategoryRepository->listMonth();
        
        if(empty($alldata)) {
           
            $data['month'] = $month;
            $data['category'] = $calendarCategory;
            $data['alldata'] = $alldata;

            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('calendar',$data);
        }

        $fullContent = $alldata;
        $dataOrder1 = $alldata[0];
        $paginatedItems = PaginateService::getPaginate($alldata,6,$request);
        // get DateTime from order1
        $date = $this->getDateTime($dataOrder1['datetime']);

        $data['alldata'] = $paginatedItems;
        $data['order1'] = $dataOrder1;
        $data['category'] = $calendarCategory;
        $data['month'] = $month;
        $data['fullContent'] = $fullContent;
        $data['dateFirst'] = $date;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('calendar',$data);
    }

    /**
     * get DateTime
     *
     * @param string $datetime
     * @return void
     */
    function getDateTime(string $datetime) {

        $checkDateTime = $datetime;

        return ($checkDateTime != [])? $date = explode(" ", date("d F Y", strtotime($checkDateTime))) : $date = [];
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
            $module = "CalendaDetail";
            
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
                    'message' => __('voyager::generic.successfully_added_new') . " {$dataType->display_name_singular}",
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
            $module = "CalendaDetail";

            $this->auditLogRepository->addLog($userName, $actions, $module);

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
            $module = "CalendaDetail";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $calendarDetail =  $this->mappingLangRepository->getTitleLastInsertCalendarDetail($request->title);
            $dataArr = array(
                'master_id'=> $calendarDetail->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'calendar-details',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $calendarDetail =  $this->mappingLangRepository->getTitleLastInsertCalendarDetail($request->title);
            $dataArr = array(
                'master_id'=> $calendarDetail->id,
                'code_lang'=>$request->_lang,
                'module'=>'calendar-details',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
