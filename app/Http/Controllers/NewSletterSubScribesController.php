<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\NewletterSubScribeRepository;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use App\Repository\AuditLogRepository;
use TCG\Voyager\Facades\Voyager;
use App\Repository\PageRepository;
use App\Repository\VisitorLogsRepository;

class NewSletterSubScribesController extends VoyagerBaseController
{
    protected $themeService;
    protected $newletterSubScribeRepository;
    protected $auditLogRepository;
    protected $pageRepository;
    protected $visitorLogsRepository;

    public function __construct(
        ThemeService $themeService,
        NewletterSubScribeRepository $newletterSubScribeRepository,
        AuditLogRepository $auditLogRepository,
        PageRepository $pageRepository,
        VisitorLogsRepository $visitorLogsRepository

    ) {
        $this->themeService = $themeService;
        $this->newletterSubScribeRepository = $newletterSubScribeRepository;
        $this->auditLogRepository = $auditLogRepository;
        $this->pageRepository = $pageRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function addmail(Request $request)
    {
        $request = $request->all();
        
        $callbackData = $this->newletterSubScribeRepository->addMail($request['newLetter']);

        if($callbackData == 'success') {

            $msgThankyou = $this->pageRepository->thankYouPageMail();
            $queryId = $this->newletterSubScribeRepository->getIdEmail($request['newLetter']);
            $id = $queryId[0]['id'];
            
            $body = $msgThankyou[0]['body']."<br>";
            $body .= "<a href='www.dot.go.th/newsletter-subscribe/edit-newsletter/".$id."'>select news for subscriber</a>";
            
            // require './vendor/autoload.php';
            $mail = new PHPMailer(); // notice the \  you have to use root namespace here
            try {
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
                $mail->Subject = "ข้อมูลข่าวสาร";
                $mail->MsgHTML($body);
                $mail->addAddress($request['newLetter'], "customer");
                $mail->send();

                if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                  } else {
                    return 'success';
                  }
            } catch (phpmailerException $e) {

                dd($e);
            } catch (Exception $e) {

                dd($e);
            }


            
        }else {
            return 'fail';
        }
    }

    public function editnewletter(int $id)
    {
        $data['newletterSubScribeGroup'] = $this->newletterSubScribeRepository->listGroupNewLetterSubScribe();
        $data['id'] = $id;
        
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        return view('newlettersubscribe-editgroup',$data);
    }

    public function updatenewletter(Request $request)
    {
        $request = $request->all();
        $id = $request['id'];
        $data =$request['data'];

        $callbackData = $this->newletterSubScribeRepository->updateNewletterSubScribe($id,$data); 
        
        if($callbackData == 'success') {
            return 'success';
        }else {
            return 'fail';
        }
        
    }

    public function addmailBackend(Request $request)
    {
        $request = $request->all();

        $idMain = $request['idCategory'];
        $mail = $request['mail'];
        $callbackData = $this->newletterSubScribeRepository->addMailInBackend($idMain,$mail);
        if($callbackData == 'success') {
            return 'success';
        }else {
            return 'fail';
        }
    }

    public function sentnewletterCategory(Request $request)
    {
        $request = $request->all();
        $idCategory = $request['idCategory'];

        $this->newletterSubScribeRepository->sentNewLetterCategory($idCategory);
        return "success";
    }

    public function sentnewletterCategorybyemail(Request $request)
    {
        $request = $request->all();
        
        $mail = $request['mail'];
        $this->newletterSubScribeRepository->sentallnewByEmail($mail);
        return "success";
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
            $module = "NewletterSubScribe";
            
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
            $module = "NewletterSubScribe";
            
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
            $module = "NewletterSubScribe";
            
            $this->auditLogRepository->addLog($userName,$actions,$module);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
}
