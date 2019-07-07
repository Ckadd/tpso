<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use App\Repository\EbookRepository;
use Theme;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\VisitorLogsRepository;
use App\Service\PaginateService;

class EbookCategoryController extends VoyagerBaseController
{
    protected $themeService;
    protected $ebookRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;

    public function __construct(
        ThemeService $themeService,
        EbookRepository $ebookRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository

    ) {
        $this->themeService = $themeService;
        $this->ebookRepository = $ebookRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function testEbook()
    {
        $ebook = $this->ebookRepository->listDataFirst();

        $emploadePathRound1 = explode(':',$ebook['file']);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);

        $data['ebook'] = $datareplece;

        return view('ebook-views',$data);
    }

    public function getIndex()
    {
        $data['ebookCategory'] = $this->ebookRepository->listDataCategory();
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('ebook-category',$data);
    }

    public function ebookGroup(Request $request,int $id)
    {
        $listdata = $this->ebookRepository->listGroup($id);
        if(!empty($listdata)) {
            $paginatedItems = PaginateService::getPaginate($listdata,5,$request);
            $data['ebookgroup'] = $paginatedItems;
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();
            
            return view('ebook-group',$data);
        }
        
        return view('ebook-group');
    }

    public function ebookView(int $id)
    {
        $ebook = $this->ebookRepository->listDataView($id);

        if(empty($ebook['ebookView']['file'])) {

            return view('ebook-group')->with('msg','ไม่มีไฟล์ข้อมูล');
        }

        $emploadePathRound1 = explode(':',$ebook['ebookView']['file']);
        $emploadePathRound2 = explode(',',$emploadePathRound1[1]);
        $emploadePathRound3 = explode('"',$emploadePathRound2[0]);
        $datareplece = str_replace('\\\\', '/', $emploadePathRound3[1]);

        $data['ebook'] = $datareplece;
        $data['idReturnBack'] = $ebook['idReturnBack'];
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('ebook-views',$data);
    }

    public function ebookDepartment(Request $request,$idDepartment, $idCategory)
    {
        $listdata = $this->ebookRepository->listDepartment($idDepartment,$idCategory);
        $paginatedItems = PaginateService::getPaginate($listdata,10,$request);
        $data['ebookgroup'] = $paginatedItems;
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('ebook-group',$data);
    }

    public function allGroupByOrganization(Request $request, int $idDepartment)
    {
        $listdata = $this->ebookRepository->listDataByOrganization($idDepartment);
        $paginatedItems = PaginateService::getPaginate($listdata,5,$request);

        $data['ebookgroup'] = $paginatedItems;
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('ebook-organization-category',$data);
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
            $module = "EbookCategoty";
            
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
            $module = "EbookCategoty";
            
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
            $module = "EbookCategoty";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
}
