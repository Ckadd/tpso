<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Repository\GraphDataRepository;
use App\Repository\GraphListRepository;
use App\Service\ThemeService;
use Theme;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use Illuminate\Support\Facades\DB;
use App\Repository\VisitorLogsRepository;
use App\Repository\OrganizationRepository;
use App\Repository\NewsCategoryRepository;
class GraphDataController extends VoyagerBaseController
{
    protected $themeService;
    protected $graphDataRepository;
    protected $grapListRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $organizationRepository;
    protected $newRepository;

    public function __construct(
        ThemeService $themeService,
        GraphDataRepository $graphDataRepository,
        GraphListRepository $grapListRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository,
        OrganizationRepository $organizationRepository,
        NewsCategoryRepository $newCategoryRepository
    ) {
        $this->themeService = $themeService;
        $this->graphDataRepository = $graphDataRepository;
        $this->grapListRepository = $grapListRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->organizationRepository = $organizationRepository;
        $this->newCategoryRepository = $newCategoryRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getIndex()
    {
        return view('graph-generate');
    }

    public function getDataById(int $id) 
    {
        $dataGraph = $this->graphDataRepository->findAllDataById($id);
        $detailGraph = $this->grapListRepository->findAllDataById($id);
        
        if(!empty($dataGraph) && !empty($detailGraph)) {
            $arrayData = [];
            foreach($dataGraph as $keydata => $valuedata) {
                $arrayData[] = $valuedata['data'];
            }
            
            $data['data'] = $arrayData;
            $data['listgraph'] = $detailGraph;
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('graph-generate',$data);
        }else{

            return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
        }
        
    }

    public function getLog(string $pathName,string $chartType,string $dbname,Request $request)
    {
        $request = $request->all();
        $startDate = $request['startdate'];
        $endDate = $request['enddate'];
        if(!empty($startDate) && !empty($endDate)) {
            if($chartType == 'line1') {
                
                // convert date
                $dateAll = $this->convertDate($startDate,$endDate);
                
                $countType = DB::table($dbname)->selectRaw('type')
                    ->groupBy('type')
                    ->orderBy('type','ASC')
                    ->get()->toArray();
                
                // getdata in datetime
                $countlog = getCountLogInDate($dbname,$dateAll['startDate'],$dateAll['endDate']);
                     
                $type = implode(',',array_column($countType,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
    
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => 'content-sharing',
                    'color'     => '#FF1493,#2468b2,#1ba1f2,#df4c42',
                    'fill_gradient' => '#fff',
                    'type'      => '1'
                ];
    
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
    
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }else if($chartType == 'pie1') {
                // convert date
                $dateAll = $this->convertDate($startDate,$endDate);

                // getdata in datetime
                $countlog = getCountLogInDate($dbname,$dateAll['startDate'],$dateAll['endDate']);
                                
                $type = implode(',',array_column($countlog,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
    
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => $type,
                    'color'     => '#1E90FF,#2E8B57,#ADFF2F,#DC143C',
                    'fill_gradient' => '#fff',
                    'type'      => '7'
                ];
    
                
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
    
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }else if($chartType == 'bar1') {
                    
                // convert date
                $dateAll = $this->convertDate($startDate,$endDate);

                // getdata in datetime
                $countlog = getCountLogInDate($dbname,$dateAll['startDate'],$dateAll['endDate']);
                                
                $type = implode(',',array_column($countlog,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
    
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => $type,
                    'color'     => '#6495ED,#2468b2,#1ba1f2,#df4c42',
                    'fill_gradient' => '#fff',
                    'type'      => '5'
                ];
    
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
    
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }else if($chartType == 'area') {
    
                $logType = ['view','facebook','twitter','googleplus'];
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
                
                // convert date
                $dateAll = $this->convertDate($startDate,$endDate);

                // getdata in datetime
                $countlog = getCountLogInDate($dbname,$dateAll['startDate'],$dateAll['endDate']);
                            
                $type = implode(',',array_column($countlog,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => 'log',
                    'color'     => '#aadddd',
                    'fill_gradient' => '#FFFFFF,#F0F8FF',
                    'type'      => '4',
                ];
                $aa[0] = ['38,1,0,127'];
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
                
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }
        }else {
            if($chartType == 'line1') {
            
                $countType = DB::table($dbname)->selectRaw('type')
                    ->groupBy('type')
                    ->orderBy('type','ASC')
                    ->get()->toArray();
                
                $countlog = getCountLog($dbname);
                     
                $type = implode(',',array_column($countType,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
    
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => 'content-sharing',
                    'color'     => '#FF1493,#2468b2,#1ba1f2,#df4c42',
                    'fill_gradient' => '#fff',
                    'type'      => '1'
                ];
    
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
    
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }else if($chartType == 'pie1') {
    
                $countlog = getCountLog($dbname);
                                
                $type = implode(',',array_column($countlog,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
    
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => $type,
                    'color'     => '#1E90FF,#2E8B57,#ADFF2F,#DC143C',
                    'fill_gradient' => '#fff',
                    'type'      => '7'
                ];
    
                
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
    
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }else if($chartType == 'bar1') {
                    
                $countlog = getCountLog($dbname);
                                
                $type = implode(',',array_column($countlog,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
    
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => $type,
                    'color'     => '#6495ED,#2468b2,#1ba1f2,#df4c42',
                    'fill_gradient' => '#fff',
                    'type'      => '5'
                ];
    
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
    
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }else if($chartType == 'area') {
    
                $logType = ['view','facebook','twitter','googleplus'];
                
                if(empty($countdata)) {
                    
                    return back()->with('msg','ไม่มีข้อมูล');
                }
                
                $countlog = getCountLog($dbname);
                            
                $type = implode(',',array_column($countlog,'type'));
                $countdata = implode(',',array_column($countlog,'count'));
                
                $detailGraph[0] = [
                    'title' => $pathName,
                    'ticklabel' => $type,
                    'legend'    => 'log',
                    'color'     => '#aadddd',
                    'fill_gradient' => '#FFFFFF,#F0F8FF',
                    'type'      => '4',
                ];
                $aa[0] = ['38,1,0,127'];
                $data['data'][0] = $countdata;
                $data['listgraph'] = $detailGraph;
                
                if(empty($data['data'][0])) {
                    
                    return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
                }
    
                /**
                 * log visitWebsite
                 */
                $this->visitorLogsRepository->addLogDot();
    
                return view('graph-generate',$data);
    
            }
        }
        
    }

    public function getAuditLog(string $pathName,string $chartType,string $module)
    {
        if($chartType == 'line1') {
            
            $countType = getModuleCountType($module);
            $countlog = getModuleCountLog($module);
            
            $type = implode(',',array_column($countType,'action'));
            $countdata = implode(',',array_column($countlog,'count'));
            
            $detailGraph[0] = [
                'title' => $pathName,
                'ticklabel' => $type,
                'legend'    => $pathName,
                'color'     => '#FF1493,#2468b2,#1ba1f2,#df4c42',
                'fill_gradient' => '#fff',
                'type'      => '1'
            ];

            $data['data'][0] = $countdata;
            $data['listgraph'] = $detailGraph;
            
            if(empty($data['data'][0])) {
                
                return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
            }

            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('graph-generate',$data);

        }else if($chartType == 'pie1') {
            
            $countType = getModuleCountType($module);
            $countlog = getModuleCountLog($module);
                            
            $type = implode(',',array_column($countType,'action'));
            $countdata = implode(',',array_column($countlog,'count'));

            $detailGraph[0] = [
                'title' => $pathName,
                'ticklabel' => $type,
                'legend'    => $type,
                'color'     => '#1E90FF,#2E8B57,#ADFF2F,#DC143C',
                'fill_gradient' => '#fff',
                'type'      => '7'
            ];
            
            
            $data['data'][0] = $countdata;
            $data['listgraph'] = $detailGraph;

            if(empty($data['data'][0])) {
                
                return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
            }

            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('graph-generate',$data);

        }else if($chartType == 'bar1') {
                
            $countType = getModuleCountType($module);
            $countlog = getModuleCountLog($module);
                            
            $type = implode(',',array_column($countType,'action'));
            $countdata = implode(',',array_column($countlog,'count'));
            
            $detailGraph[0] = [
                'title' => $pathName,
                'ticklabel' => $type,
                'legend'    => $pathName,
                'color'     => '#6495ED,#2468b2,#1ba1f2,#df4c42',
                'fill_gradient' => '#fff',
                'type'      => '5'
            ];

            $data['data'][0] = $countdata;
            $data['listgraph'] = $detailGraph;
            
            if(empty($data['data'][0])) {
                
                return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
            }

            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('graph-generate',$data);

        }else if($chartType == 'area') {

            $logType = ['view','facebook','twitter','googleplus'];
            
            
            $countType = getModuleCountType($module);
            $countlog = getModuleCountLog($module);
                            
            $type = implode(',',array_column($countType,'action'));
            $countdata = implode(',',array_column($countlog,'count'));
                        
            
            
            $detailGraph[0] = [
                'title' => $pathName,
                'ticklabel' => $type,
                'legend'    => 'log',
                'color'     => '#aadddd',
                'fill_gradient' => '#FFFFFF,#F0F8FF',
                'type'      => '4',
            ];
            
            $data['data'][0] = $countdata;
            $data['listgraph'] = $detailGraph;
            
            if(empty($data['data'][0])) {
                
                return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
            }
            
            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('graph-generate',$data);
        }
        
    }

    public function convertDate(string $startDate,string $endDate) {
        
        // convert date
        $explodeStartDate = explode(" ",$startDate); 
        $startDate = date("Y-m-d", strtotime($explodeStartDate[0]));
        
        $explodeEndDate = explode(" ",$endDate); 
        $endDate = date("Y-m-d", strtotime($explodeEndDate[0]));

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return $data;
    }

    public function getLogOraganization(Request $request, string $type)
    {
        $request = $request->all();
        $categoryId = $request['category'];
        $date = ($request['dateOrganization'] != "")? explode('/',$request['dateOrganization']) : [];
        $queryOrganizationId = $this->organizationRepository->allOrganizationId();
        $allId = array_column($queryOrganizationId,'id');
        $dataNewCount = $this->newCategoryRepository->countNewsByOrganization($allId,$date,$categoryId);

        // get name organizaiton Id
        $getTypeId = [];
        foreach($queryOrganizationId as $keyId => $valueId) {
            $getTypeId[] = $valueId['name'];
        }
       
        // gen graph
        // check type pie or bar
        $typeGraph = ($type == 'pie') ? '7' : '5';
        $type = implode(',',$getTypeId);
        $countdata = implode(',',$dataNewCount);
       
        $detailGraph[0] = [
            'title' => 'Organization News',
            'ticklabel' => $type,
            'legend'    => $type,
            'color'     => '#1E90FF,#2E8B57,#ADFF2F,#DC143C,#ff9999,#ffff00,#4da6ff,#004080,#006666,#00cc99,#4dffd2,#7094db,#1f3d7a,#ff66ff,#990099,#6666ff,#4dd2ff,#00bfff,#cc99ff,#a64dff,#7300e6,#666699,#ff33cc,#a64dff,#99ff66,#4ce600,#99e600,#ff33bb',
            'fill_gradient' => '#fff',
            'type'      => $typeGraph
        ];
        
        $data['data'][0] = $countdata;
        $data['listgraph'] = $detailGraph;

        if(empty($data['data'][0])) {
            
            return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('graph-generate-organization',$data);
    }

    public function getLogOraganizationId(Request $request,int $organizationId,string $type)
    {
        $request = $request->all();
        $organizationId = [$organizationId];
        $date = ($request['dateOrganization'] != "")? explode('/',$request['dateOrganization']) : [];
        $dataNewCount = $this->newCategoryRepository->countNewsByOrganization($organizationId,$date);
        $typeGraph = ($type == 'pie') ? '7' : '5';
        $countdata = implode(',',$dataNewCount);
        $detailGraph[0] = [
            'title' => 'Organization News',
            'ticklabel' => 'organization:'.$organizationId[0],
            'legend'    => 'organization:'.$organizationId[0],
            'color'     => '#1E90FF,#2E8B57,#ADFF2F,#DC143C,#ff9999,#ffff00,#4da6ff,#004080,#006666,#00cc99,#4dffd2,#7094db,#1f3d7a,#ff66ff,#990099,#6666ff,#4dd2ff,#00bfff,#cc99ff,#a64dff,#7300e6,#666699,#ff33cc,#a64dff,#99ff66,#4ce600,#99e600,#ff33bb',
            'fill_gradient' => '#fff',
            'type'      => $typeGraph
        ];
        
        $data['data'][0] = $countdata;
        $data['listgraph'] = $detailGraph;

        if(empty($data['data'][0])) {
            
            return redirect('/graph-generate')->with('msg','ไม่มีข้อมูล');
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('graph-generate',$data);
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
            $module = "GraphData";
            
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
            $module = "GraphData";
            
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
            $module = "GraphData";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
}
