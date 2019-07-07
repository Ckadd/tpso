<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;
use App\Repository\FormGenerateRepository;
use App\Service\ThemeService;
use App\Repository\FormGenerateDetailRepository;
use App\Repository\PageRepository;
use Theme;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use App\Repository\VisitorLogsRepository;
use App\Exports\YourExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormgenerateExport;
use App\Exports\FormGenerateData;
class FormGenerateController extends VoyagerBaseController
{

    protected $themeService;
    protected $formGenerateRepository;
    protected $formGenerateDetailRepository;
    protected $pageRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;

    public function __construct(
        ThemeService $themeService,
        FormGenerateRepository $formGenerateRepository,
        FormGenerateDetailRepository $formGenerateDetailRepository,
        PageRepository $pageRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository
    ) {
        $this->themeService = $themeService;
        $this->formGenerateRepository = $formGenerateRepository;
        $this->formGenerateDetailRepository = $formGenerateDetailRepository;
        $this->pageRepository = $pageRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    /**
     * add userid to form-generate backend voyager.
     *
     * @param Request $request type request
     *
     * @return void \TCG\Voyager\Http\Controllers\VoyagerBaseController
     */
    // public function store(Request $request)
    // {
    //     $request->request->add(['user_id' => auth()->user()->id]);

    //     return parent::store($request);
    // }

    public function detail(int $id)
    {
        $formGenerate = $this->formGenerateRepository->listDataById($id);
        $data['formGenerate'] = $formGenerate;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('form-generate-detail',$data);
    }

    public function addDetail(Request $request)
    {
        $requestForm = $request->all();

        $id = $requestForm['idForm'];
        $queryFormGenerate = $this->formGenerateRepository->listDataById($id);
        $formGenerate =  json_decode($queryFormGenerate['form'], true);

        $queryAddForm = $this->formGenerateDetailRepository->addDetail($request,$formGenerate);
        if($queryAddForm == 'success') {
            $query = $this->pageRepository->listPageThankYou();
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            if(!empty($query)) {
                $idPage = $query[0]['id'];
                return redirect('pages/'.$idPage);
            }
            
            return back();
           
            
            
            // return redirect('form-generate/'.$id)->with('message','บันทึกข้อมูลเสร็จสิ้น');
        }        
    }

    public function exportData($id,Request $request)
    {
        $request = $request->all();

        ($request['startdate'] != []) ? $startDate = $request['startdate']
                                        : $startDate = '';
        ($request['enddate'] != []) ? $endDate = $request['enddate']
                                        : $endDate = '';
        
        $dataForm = $this->formGenerateRepository->listdataById($id);
        ($dataForm != []) ? $fileName = $dataForm['form_name'] : $fileName = "FILE DOT";
                                        
        // return (new FormgenerateExport($id))->download('invoices.xlsx');
        return Excel::download(new FormGenerateData($id,$startDate,$endDate), $fileName.'.xlsx');
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
        
        // check strtdate more endate
        if($request['start_date'] > $request['end_date']) {
            return back()->with('msg','start_date more end_date');
        }
        
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
            $module = "FormGenerate";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);


            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            event(new BreadDataAdded($dataType, $data));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }

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
            $module = "FormGenerate";
            
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
            $module = "FormGenerate";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
}
