<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ThemeService;
use Theme;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Repository\ContactUsRepository;
use App\Repository\VisitorLogsRepository;
use App\Repository\PostRepository;
class ContactUsController extends Controller
{
    protected $themeService;
    protected $contactUsRepository;
    protected $visitorLogsRepository;
    protected $postRepository;

    public function __construct(
        ThemeService $themeService,
        ContactUsRepository $contactUsRepository,
        VisitorLogsRepository $visitorLogsRepository,
        PostRepository $postRepository
    ) {
        $this->themeService = $themeService;
        $this->contactUsRepository = $contactUsRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->postRepository = $postRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    public function index()
    {
        $contactAddress = $this->postRepository->contactAddress();
        $contactTravel = $this->postRepository->contactTravel();

        $data['address'] = $contactAddress;
        $data['travel'] = $contactTravel;

        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();

        return view('contact-us',$data);
    }

    public function sendemail(Request $request)
    {
        $request = $request->all();
        $dataContact = [$request['fullname'],$request['number-id'],$request['phone'],$request['email'],$request['title'],$request['body']];
        
        // add log contact
        $this->contactUsRepository->addLogContactUs($dataContact);
        
        $imgContent = asset('/themes/dot/assets/images/dotlogo.png');
        $msgContent  = "<img src='$imgContent'>
        <h1>ข้อมูลสำหรับติดต่อกรมการท่องเที่ยว</h1>
        <table border='solid 1px;'>
        <tr>
            <th></th><th></th>
        </tr>
        <tr>
            <td>ชื่อ-นามสกุล</td>
            <td>".$request['fullname']."</td>
        </tr>
        <tr>
            <td>หมายเลขบัตรประชาชน</td>
            <td>".$request['number-id']."</td>
        </tr>
        <tr>
            <td>หมายเลขโทรศัพท์</td>
            <td>".$request['phone']."</td>
        </tr>
        <tr>
            <td>อีเมล์</td>
            <td>".$request['email']."</td>
        </tr>
        <tr>
            <td>หัวข้อติดต่อ</td>
            <td>".$request['title']."</td>
        </tr>
        <tr>
            <td>ข้อความ</td>
            <td>".$request['body']."</td>
        </tr>
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
        $mail->Subject = $request['title'];
        $mail->MsgHTML($msgContent);
        $mail->addAddress("dot.tourismth@gmail.com", "customer");
        $mail->send();

        return back()->with('msg','ส่งข้อมูลติดต่อกรมเสร็จสิ้น');
    }
}
