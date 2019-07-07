<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;
use App\Service\ThemeService;
use Theme;
use App\Repository\FaqCategoryRepository;
use App\Repository\FaqRepository;
use PDF;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Service\PaginateService;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\MappingLangRepository;
class FaqsController extends VoyagerBaseController
{
    protected $themeService;
    protected $faqCategoryRepositoty;
    protected $faqRepository;
    protected $auditLogRepository;
    protected $visitorLogsRepository;
    protected $mappingLangRepository;

    public function __construct(
        ThemeService $themeService,
        FaqCategoryRepository $faqCategoryRepositoty,
        FaqRepository $faqRepository,
        AuditLogRepository $auditLogRepository,
        VisitorLogsRepository $visitorLogsRepository,
        MappingLangRepository $mappingLangRepository

    ) {
        $this->themeService = $themeService;
        $this->faqCategoryRepositoty = $faqCategoryRepositoty;
        $this->faqRepository = $faqRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->mappingLangRepository = $mappingLangRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function getIndex(Request $request)
    {
        $idCategory = $this->faqCategoryRepositoty->listData();
        
        if(!empty($idCategory)) {
            
            $data = $this->faqRepository->listData($idCategory);
            $category = $this->faqCategoryRepositoty->listCategory();
           
            $paginatedItems = PaginateService::getPaginate($data['dataFaqs'][0],6,$request);
            
            $data['dataFaqs'] = $paginatedItems;
            $data['category'] = $category;

            /**
             * log visitWebsite
             */
            $this->visitorLogsRepository->addLogDot();

            return view('faqs',$data);
        }

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('faqs');
    }

    public function downloadpdf(int $id)
    {
        
        $data['data'] = $this->faqRepository->listDataById($id);

        $pdf = PDF::loadView('faq-pdf',$data);
       
        return @$pdf->stream();
        // return view('faq-pdf');
    }

    public function sentmailfaq(Request $request)
    {
        $request = $request->all();
        $id = $request['id'];
        $email = $request['email'];
        $data = $this->faqRepository->listDataById($id);
        
        $imgContent = asset('/themes/dot/assets/images/dotlogo.png');
        $msgContent  = "<img src='$imgContent'>
        <table border='solid 1px;'>
        <tr><th style='background-color:#8ed6d7; color:black;'>".$data['title']."</th></tr>
        <tr><td>".$data['content']."</td></tr>
        </table>";
        
        $mail = new PHPMailer(); // notice the \  you have to use root namespace here

        $mail->isSMTP(); // tell to use smtp
        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure = "ssl"; // or ssl
        $mail->Host = "smtp.gmail.com"; //ssl://smtp.gmail.com
        $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing. 
        $mail->Username = "dot.tourismth@gmail.com";
        $mail->Password = "Dot7654321";
        $mail->setFrom("dot.tourismth@gmail.com", "Dot-website");
        $mail->Subject = "แชร์คำถามจากกรมการท่องเที่ยว:".$data['title'];
        $mail->MsgHTML($msgContent);
        $mail->addAddress($email, "customer");
        $mail->send();
        return "success";
    }

    public function search(Request $request)
    {
        $request = $request->all();
        
        $categoryName = $request['category'];
        $keyword = $request['keyword'];
        
        if(!empty($categoryName) && empty($keyword)) {
            
            $idCategory = $this->faqCategoryRepositoty->listCategoryByName($categoryName);
            $faqIdCategory = $this->faqCategoryRepositoty->listData();
            $data = $this->faqRepository->listDataByIdCategory($idCategory,$faqIdCategory);

            $request = new Request();
            $paginatedItems = PaginateService::getPaginate($data['dataFaqs'][0],6,$request);
            
            $data['dataFaqs'] = $paginatedItems;
            
            $category = $this->faqCategoryRepositoty->listCategory();
            $data['category'] = $category;
            
            return view('faqs',$data);
        }else if(!empty($categoryName) && !empty($keyword)) {
            
            $idCategory = $this->faqCategoryRepositoty->listCategoryByName($categoryName);
            
            // list all category becuase query feature faq
            $faqIdCategory = $this->faqCategoryRepositoty->listData();

            // list by keyword
            $data = $this->faqRepository->listDataByIdCategoryAndKeyword($idCategory,$faqIdCategory,$keyword);
            $request = new Request();
            $paginatedItems = PaginateService::getPaginate($data['dataFaqs'][0],6,$request);
            
            $data['dataFaqs'] = $paginatedItems;
            $category = $this->faqCategoryRepositoty->listCategory();
            $data['category'] = $category;

            return view('faqs',$data);
        }else if(!empty($keyword) && empty($categoryName)) {
            $idCategory = $this->faqCategoryRepositoty->listData();
            
            if(!empty($idCategory)) {
                
                $data = $this->faqRepository->listdataByKeyword($idCategory,$keyword);
                $category = $this->faqCategoryRepositoty->listCategory();
                
                $request = new Request();
                $paginatedItems = PaginateService::getPaginate($data['dataFaqs'][0],6,$request);
            
                $data['dataFaqs'] = $paginatedItems;

                $data['category'] = $category;
                
                return view('faqs',$data);
            }else {

                return redirect('/faqs');
            }
        }
        return redirect('/faqs');
    }

    /**
     * add userid to faqCategories backend voyager.
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
        $request->request->add(['user_id' => auth()->user()->id]);
        $slug = $this->getSlug($request);

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
            $module = "Faqs";
            
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
            $module = "Faqs";
            
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
            $module = "Faqs";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    private function addMappingLang($request){
        if(!empty($request->master_id)){
            $data =  $this->mappingLangRepository->getTitleLastInsertFaq($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'parent_id'=>$request->master_id,
                'code_lang'=>$request->_lang,
                'module'=>'faqs',
                'created_at'=>date('Y-m-d H:i:s'));
        }else{
            $data =  $this->mappingLangRepository->getTitleLastInsertFaq($request->title);
            $dataArr = array(
                'master_id'=> $data->id,
                'code_lang'=>$request->_lang,
                'module'=>'faqs',
                'created_at'=>date('Y-m-d H:i:s'));
        }
        $this->mappingLangRepository->add($dataArr);
    }
}
