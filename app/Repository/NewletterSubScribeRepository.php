<?php

namespace App\Repository;

use App\model\NewsletterSubscribe;
use App\Model\NewsletterCategory;
use App\Model\NewletterSubscribeDetail;
use App\Model\NewsletterTemplate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DateTime;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Model\MappingNewsletter;

class NewletterSubScribeRepository { 

    protected $newletterSubScribeRepository;
    protected $newletterCategoryRepository;
    protected $newletterSubscribeDetailRepository;
    protected $newletterTemplateRepository;
    protected $mappingNewsletterModel;

    public function __construct(NewsletterSubscribe $newletterSubScribeRepository,NewsletterCategory $newletterCategoryRepository,NewletterSubscribeDetail $newletterSubscribeDetailRepository,NewsletterTemplate $newletterTemplateRepository,MappingNewsletter $mappingNewsletterModel) { 
        $this->newletterSubScribeRepository = $newletterSubScribeRepository;
        $this->newletterCategoryRepository = $newletterCategoryRepository;
        $this->newletterSubscribeDetailRepository = $newletterSubscribeDetailRepository;
        $this->newletterTemplateRepository = $newletterTemplateRepository;
        $this->mappingNewsletterModel = $mappingNewsletterModel;
    }

    public function addMail(string $mail) {
        
        $newCategoryArray = $this->newletterCategoryRepository::where('status',1)->get()->toArray();
        
        $newCategory = \json_encode($newCategoryArray,true);
        $checkMail = $this->newletterSubScribeRepository::where('email',$mail)->get()->toArray();
    
        if(empty($checkMail)){ 
            $this->newletterSubScribeRepository->insert([
                'email' => $mail,
                'status' => 1,
                'subscribe' => $newCategory,
                'datetime' => date("Y-m-d H:i:s")
            ]);
        }
        $idMail = $this->newletterSubScribeRepository->select('id')->where('email',$mail)->get()->toArray();
        
        $newDetail = $this->newletterSubscribeDetailRepository::where('newletter_id',$idMail[0]['id'])->get()->toArray();
        if(empty($newDetail)) {
            foreach($newCategoryArray as $keyCategory => $valCategory) {
                
                $checkDetail = $this->newletterSubscribeDetailRepository->where('category_id',$valCategory['id'])
                ->where('newletter_id',$idMail[0]['id'])->get()->toArray();
                
                if(empty($checkDetail)) {
                    $this->newletterSubscribeDetailRepository->insert([
                        'category_id' => $valCategory['id'],
                        'newletter_id' => $idMail[0]['id'],
                        'datetime' => date("Y-m-d H:i:s")
                    ]);
                }
            }
        }        
        $data = true;

        if($data == true) {
            $callbackData = 'success';
            return $callbackData;
        }else {
            $callbackData = 'fail';
            return $callbackData;
        }

    }

    public function listGroupNewLetterSubScribe() {
        try {
            $newCategory = $this->newletterCategoryRepository::where('status',1)->get()->toArray();
            
            return $newCategory;
        }catch(ModelNotFoundException $e) {
            
            return [];
        }
    }

    public function getIdEmail(string $email){

        return $this->newletterSubScribeRepository::where('email',$email)->get()->toArray();
    }

    public function updateNewletterSubScribe(int $id,array $data) {
        
        if($data[0] == 'all') {
            //delete data
            $this->newletterSubscribeDetailRepository->where('newletter_id',$id)->delete();

            //add data
            $newCategory = $this->newletterCategoryRepository::where('status',1)->get()->toArray();
            $idCategory = array_column($newCategory,'id');
            foreach($idCategory as $keyCategory => $valCategory) {
                $this->newletterSubscribeDetailRepository->insert([
                    'category_id' => $valCategory,
                    'newletter_id' => $id,
                    'datetime' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }

            $callbackData = 'success';
            return $callbackData;
        }

        $this->newletterSubscribeDetailRepository->where('newletter_id',$id)->delete();
        
        foreach($data as $keydata => $valdata) {
            $this->newletterSubscribeDetailRepository->insert([
                'category_id' => $valdata,
                'newletter_id' => $id,
                'datetime' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }    

        $callbackData = 'success';

        return $callbackData;
    }

    public function findDetailInNewletterDetail(int $id) {
        
        $data = $this->newletterCategoryRepository->where('id',$id)->with('newletterDetail')
        ->get()->toArray();

        $listEmail = [];
        foreach($data[0]['newletter_detail'] as $keynew => $valnew) {
            $quertEmail = $this->newletterSubScribeRepository->select('email')
            ->where('id',$valnew['newletter_id'])->get()->toArray();

            $listEmail['Email'][$keynew] = $quertEmail[0]['email'];
        }
       return $listEmail;
    }


    public function addMailInBackend(int $id,string $mail) {
        
        $newCategoryArray = $this->newletterCategoryRepository::where('status',1)->get()->toArray();
        $newCategory = \json_encode($newCategoryArray,true);
        $checkEmailSubScribe = $this->newletterSubScribeRepository->where('email',$mail)->get()->toArray();
        if(empty($checkEmailSubScribe)) {
            $this->newletterSubScribeRepository->insert([
                'email' => $mail,
                'status' => 1,
                'subscribe' => $newCategory,
                'datetime' => date("Y-m-d H:i:s")
            ]);
        }

        $idMail = $this->newletterSubScribeRepository->select('id')->where('email',$mail)->get()->toArray();
        
        $this->newletterSubscribeDetailRepository->insert([
            'category_id' => $id,
            'newletter_id' => $idMail[0]['id'],
            'datetime' => date("Y-m-d H:i:s")
        ]);       
        $data = true;

        if($data == true) {
            $callbackData = 'success';
            return $callbackData;
        }else {
            $callbackData = 'fail';
            return $callbackData;
        }

    }

    public function sentNewLetterCategory(int $id){ 
        
        $template = $this->newletterTemplateRepository->where('newsletter_category_id',$id)
        ->get()->toArray();

        // select title from category
        $queryTitle = $this->newletterCategoryRepository->where('id',$id)
        ->get()->toArray();
        $title = $queryTitle[0]['newsletter_title'];

        // select email
        $newLetterId = $this->newletterSubscribeDetailRepository->select('newletter_id')
        ->where('category_id',$id)->get()->toArray();
        $emailCustomer = $this->newletterSubScribeRepository->whereIn('id',$newLetterId)
        ->get()->toArray();

        $dataColumn = array_column($emailCustomer, 'email');

        $mail = new PHPMailer(); // notice the \  you have to use root namespace here

        foreach($template as $keytemplate => $valtemplate) {
            
            $valtemplate['newletter'] .= "<br>";
            $valtemplate['newletter'] .= "<a href='www.dot.go.th/newsletter-subscribe/edit-newsletter/".$id."'>select news for subscriber</a>";
            
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
            $mail->Subject = $title;
            $mail->MsgHTML($valtemplate['newletter']);
            foreach($dataColumn as $keymail => $valmail) { 
                $mail->addAddress($valmail, "customer");
            }
            $mail->send();
        }

        return ;
    }

    public function sentallnewByEmail(string $Email) {
        
        $queryId = $this->newletterSubScribeRepository->where('email',$Email)
        ->get()->toArray();
        $id = $queryId[0]["id"];

        
        $category =$this->newletterSubscribeDetailRepository
        ->select('category_id')
        ->where('newletter_id',$id)
        ->get()->toArray();

        $queryId = $this->newletterCategoryRepository->whereIn('id',$category)
        ->where('status',1)->get()->toArray();
        $categoryStatus = array_column($queryId,'id');
        
        // select title from category
        $queryTitle = $this->newletterCategoryRepository->whereIn('id',$category)
        ->get()->toArray();
        
        // $title = $queryTitle[0]['newsletter_title'];

        $template = $this->newletterTemplateRepository->whereIn('newsletter_category_id',$categoryStatus)
        ->where('status',1)
        ->get()->toArray();

        if(!empty($template)) {
            $newTemplate = [];
            foreach($template as $keytem => $valtem) {
                
                $title = $this->newletterCategoryRepository->where('id',$valtem['newsletter_category_id'])
                ->where('status',1)
                ->get()->toArray();
                $newTemplate[] = array_merge($template[$keytem],$title[0]);
                
                // $template[$keytem];
            }
        
        
            $mail = new PHPMailer();

            foreach($newTemplate as $keytemplate => $valtemplate) {
                $valtemplate['newletter'] .= "<br>";
                $valtemplate['newletter'] .= "<a href='www.dot.go.th/newsletter-subscribe/edit-newsletter/".$id."'>select news for subscriber</a>";
                
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
                $mail->Subject = $valtemplate['newsletter_title'];
                $mail->MsgHTML($valtemplate['newletter']);
                $mail->addAddress($Email, "customer");
                $mail->send();
            }
    
            return ;
        }else {
            return;
        }
    }

    public function sendMailNews(int $newCategoryId,array $organizationId,array $data) {
        
        $mappingId = $this->mappingNewsletterModel->where('status',1)
        ->where('news_cate_id',$newCategoryId)
        ->whereIn('organization_id',$organizationId)
        ->get()->toArray();
        
        // get id newletter category
        $newletterCategoryId = array_column($mappingId,'newsletter_cate_id');

        

        // select email
        $newLetterId = $this->newletterSubscribeDetailRepository->select('newletter_id')
        ->whereIn('category_id',$newletterCategoryId)->get()->toArray();
       
        $emailCustomer = $this->newletterSubScribeRepository->whereIn('id',$newLetterId)
        ->get()->toArray();

        $dataEmail = array_column($emailCustomer, 'email');
        
        // $coverImg = url('/storage/app/public/'.$data['cover_image']);
        
        $coverImg = '';
        
        $mail = new PHPMailer();
        $template = "";
        $template .= "<img src='".$coverImg."'>";
        $template .= "<br>";
        $template .= " ".$data['short_description']." ";
        $template .= "<br>";
        $template .= "<a href='www.dot.go.th/news/another/detail/".$data['id']."'>link to read news</a>";
        
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
        $mail->Subject = $data['title'];
        $mail->MsgHTML($template);
        foreach($dataEmail as $keymail => $valmail) { 
            $mail->addAddress($valmail, "customer");
        }
            $mail->send();
        return ;
        
    }
}