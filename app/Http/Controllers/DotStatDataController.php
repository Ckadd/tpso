<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\MappingLangRepository;
use App;
use App\Repository\DotStatRepository;
use Illuminate\Support\Facades\Input;

class DotStatDataController extends VoyagerBaseController
{
    protected $auditLogRepository;
    protected $mappingLangRepository;
    protected $dotStatRepository;
    protected $themeService;

    public function __construct(
        AuditLogRepository $auditLogRepository,
        MappingLangRepository $mappingLangRepository,
        DotStatRepository $dotStatRepository,
        ThemeService $themeService
    )
    {
        $this->auditLogRepository = $auditLogRepository;
        $this->mappingLangRepository = $mappingLangRepository;
        $this->dotStatRepository = $dotStatRepository;
        $this->themeService = $themeService;
        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getIndex()
    {
        $menu = $this->dotStatRepository->getMenuData();
        
        // function get Date-Month-Year
        $data = $this->getDateMonth(App::getLocale());
        $data['group'] = $menu;
        
        return view('dot-stat',$data);  
    }

    public function getDataMenu(int $id)
    {
        $queryCategory = $this->dotStatRepository->listDataCategory($id);
        $menu = $this->dotStatRepository->getMenuData();

        // function get Date-Month-Year
        $data = $this->getDateMonth();
        $data['data'] = $queryCategory;
        $data['group'] = $menu;
        
        return view('dot-stat',$data); 
    }

    public function search(Request $request)
    {
        $request = $request->all();
        $category = $request['category'];
        $month = $request['month'];
        $year = $request['year'];
        $queryData = $this->dotStatRepository->getDataSearch($category,$month,$year);
        $queryCategory = $this->dotStatRepository->listDataCategory($category);
        $menu = $this->dotStatRepository->getMenuData();
        
        // function get Date-Month-Year
        $data = $this->getDateMonth();
        $data['data'] = $queryCategory;
        $data['group'] = $menu;
        $data['dataStat'] = $queryData;
        
        return view('dot-stat',$data);
    }
    
    public function download(int $id,string $nameFile)
    {
        
        $data = $this->dotStatRepository->listStatData($id);
        
        if(!empty($data)) {
            $file = $data[$nameFile];
            $encodeFile = json_decode($file,true);
            $path = storage_path('/app/public/'.$encodeFile[0]['download_link']);
            
            return response()->download($path);
        }
       return back();
    }

    private function getDateMonth(string $lang) {
        if($lang == 'th') {
            $dataMonth = [
                '01'  => 'มกราคม',
                '02'  => 'กุมภาพันธ์',
                '03'  => 'มีนาคม',
                '04'  => 'เมษายน',
                '05'  => 'พฤศภาคม',
                '06'  => 'มิถุนายน',
                '07'  => 'กรกฎาคม',
                '08'  => 'สิงหาคม',
                '09'  => 'กันยายน',
                '10' => 'ตุลาคม',
                '11' => 'พฤศจิกายน',
                '12' => 'ธันวาคม',
            ];
        }else {
            $dataMonth = [
                '01'  => 'January',
                '02'  => 'February',
                '03'  => 'March',
                '04'  => 'April',
                '05'  => 'May',
                '06'  => 'June',
                '07'  => 'July',
                '08'  => 'August',
                '09'  => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December',
            ];
        }
    
        $yearNow = date('Y');
        $now = explode('-',date('Y-m'));
        
        // get Year now up to 60 year give back
        $dateYear = [];
        for($i=0; $i < 60; $i++) {
            $dateYear[] = ($yearNow+543) - $i;
        }
        
        $data['month'] = $dataMonth;
        $data['year'] = $dateYear;
        $data['dateNow'] = $now;

        return $data;
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
        $request->request->add(['created_by' => auth()->user()->id]);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }
        $file1 = Input::file('file1');
        
        if(empty($file1)) {
            return back()->with('msg','Please browse file1');
        }
    

        if (!$request->has('_validate')) {

            /**
             * add auditLog
             * @param userid $userId @param action $actions @param module $module
             */
            $userName = auth()->user()->name;
            $actions = "create";
            $module = "DotStatData";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);


            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            event(new BreadDataAdded($dataType, $data));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }
            $this->addMappingLang($request);
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
        $request->request->add(['created_by' => auth()->user()->id]);
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
            $module = "DotStatData";
            
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
            $module = "DotStatData";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertDotStatData();
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'dot-stat-datas',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertDotStatData();
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'dot-stat-datas',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
