<?php

namespace App\Repository;

use App\Model\FormGenerateDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use App\Model\Page;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;
class FormGenerateDetailRepository
{
    protected $formGenerateDetailRepository;
    protected $pageRepository;

    public function __construct(FormGenerateDetail $formGenerateDetailRepository,Page $pageRepository)
    {
        $this->formGenerateDetailRepository = $formGenerateDetailRepository;
        $this->pageRepository               = $pageRepository;
    }

    public function addDetail(Request $request,array $formGenerate) { 
        try {
            $request  = $request->all();
            $idForm = $request['idForm'];
            $mail = new PHPMailer(); // notice the \  you have to use root namespace here

            $pageMsg = $this->pageRepository->where('slug','thank-you-mail')->get()->toArray();
            
            if(!empty($pageMsg)) {
                $pageTitle = $pageMsg[0]['title'];
                $pageBody  = $pageMsg[0]['body'];

            }else {
                $pageTitle = "thank";
                $pageBody = "thank";
            }
            
            
            foreach($formGenerate as $keyform => $valform) {
                
                if((array_key_exists("subtype",$valform))) {
                    
                    if($valform['subtype'] == "email") {
                    
                        $this->formGenerateDetailRepository->insert([
                        'form_id' => $idForm,
                        'type'    => $valform['subtype'],
                        'name'    => $valform['name'],
                        'value'   => $request[$valform['name']] ?? $valform['subtype'],
                        'created_at' => Carbon::today(),
                        'updated_at' => Carbon::today()
                    ]);
    
                        /**
                         * sent smtp email to customer
                         *
                         * @return void
                         */
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
                        $mail->Subject = $pageTitle;
                        $mail->MsgHTML($pageBody);
                        $mail->addAddress($request[$valform['name']], "customer");
                        $mail->send();
                    }
                }else {
                    if(!empty($valform['name'])) {
                        $this->formGenerateDetailRepository->insert([
                            'form_id' => $idForm,
                            'type'    => $valform['type'],
                            'name'    => $valform['name'],
                            'value'   => $request[$valform['name']] ?? $valform['type'],
                            'created_at' => Carbon::today(),
                            'updated_at' => Carbon::today()
                        ]);
                    }else {
                        $this->formGenerateDetailRepository->insert([
                            'form_id' => $idForm,
                            'type'    => $valform['type'],
                            'name'    => $valform['type'],
                            'value'   => $valform['label'],
                            'created_at' => Carbon::today(),
                            'updated_at' => Carbon::today()
                        ]);
                    }
                }          
            }

            $success = "success";
            return $success;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }
}
