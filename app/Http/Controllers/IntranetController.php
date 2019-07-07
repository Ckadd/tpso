<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ThemeService;
use Theme;
use Ixudra\Curl\Facades\Curl;
use Session;
use App\Repository\OrganizationRepository;
use App\Repository\NewsCategoryRepository;
use App\Repository\BannerRepository;
class IntranetController extends Controller
{
    protected $themeService;
    protected $organizationRepository;
    protected $newsCategoryRepository;
    protected $bannerRepository;
    private $server_url = "http://127.0.0.1";

    public function __construct(
        ThemeService $themeService,
        OrganizationRepository $organizationRepository,
        NewsCategoryRepository $newsCategoryRepository,
        BannerRepository $bannerRepository
    ) {
        $this->organizationRepository = $organizationRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->themeService = $themeService;
        $this->bannerRepository = $bannerRepository;

        $this->server_url = env('INTRANET_URL', "http://61.19.55.30");

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function addIntranet()
    {
        $data = array();
        // get organizationIntranet
        $organizationIntranet = $this->organizationRepository->OrganizationIntranet();
        if(!empty($organizationIntranet)) {
            $intranetAnnounce = $this->newsCategoryRepository->intranetNews($organizationIntranet->id,'ประกาศกรมการท่องเที่ยว',5);
            $intranetAnnounceRegistrar = $this->newsCategoryRepository->intranetNews($organizationIntranet->id,'ประกาศกรมนายทะเบียน',5);
            $intranetAnnounceInformation = $this->newsCategoryRepository->intranetNews($organizationIntranet->id,'ประกาศจากกลุ่มเทคโนโลยีสารสนเทศ',5);
            $intranetAnnounceStaff  = $this->newsCategoryRepository->intranetNews($organizationIntranet->id,'ประกาศจากกองการเจ้าหน้าที่',5);
            $intranetBookDot  = $this->newsCategoryRepository->intranetNews($organizationIntranet->id,'หนังสือเวียนจากกรมการท่องเที่ยว',5);
            $intranetActivity  = $this->newsCategoryRepository->intranetNews($organizationIntranet->id,'ข่าวกิจกรรม',3);
            
            //list banner Intranet
            $banner = $this->bannerRepository->listdataIntranet($organizationIntranet->id);

            $data['menu'] = $banner;
            $data['announce'] = $intranetAnnounce;
            $data['registar'] = $intranetAnnounceRegistrar;
            $data['information'] = $intranetAnnounceInformation;
            $data['staff'] = $intranetAnnounceStaff;
            $data['bookDot'] = $intranetBookDot;
            $data['activity'] = $intranetActivity;
            
        }

        return $data;
    }

    public function index()
    {
        if(session()->get('status_login')) {
            $data = $this->addIntranet();
            $data['user_data'] = array();
            $data['server_url'] = $this->server_url;
            if (session()->has('data')) {
                $data['user_data'] = session()->get('data');
            }
            return view('intranet', $data);
        }
        return view('intranet-login');
    }

    public function login()
    {
        return view('intranet-login');

    }

    public function checkLogin(Request $request)
    {
        $r = $this->curlCheckLogin($request->username,$request->password);
        if($r == true){
            return redirect('intranet');
        }
        return redirect('intranet/login')->with('status', 'Invalid Login Credentials !');
    }

    public function logout(){
        session()->forget('data');
        session()->forget('status_login');
        return redirect('intranet/login');
    }

    private function curlCheckLogin($user,$pass)
    {

        $response = Curl::to($this->server_url.'/api/v1/dot_login.php')
        ->withData( array( 'username' => $user,'password'=>$pass ) )
        ->get();
        $json = json_decode($response, true);
        $json['data']['login_encoded'] = md5($json['result']);
        $res = false;
        if($json['result'] == 'success'){
            Session::put('status_login',true);
            Session::put('data',$json['data']);
            $res = true;
        }else{
            Session::put('status_login',false);
            $res = false;
        }
        return $res;
       
    }

    private function apiInformationBureau($id='',$keyword=''){
        $response = array();
         if(!empty($id)){
            $response = Curl::to($this->server_url.'/api/v1/dot_department.php?id='.$id)
            ->get();
        }else   if(!empty($keyword)){
            $response = Curl::to($this->server_url.'/api/v1/dot_department.php?keyword='.$keyword)
            ->get();
          
        }else{
            $response = Curl::to($this->server_url.'/api/v1/dot_department.php')
            ->get();
        }
        
        $json = json_decode($response, true);
        return $json;
    }

    private function apiDotSubdepartment($id='',$deptID='',$keyword=''){
        $response = array();
        if(!empty($id)){
            $response = Curl::to($this->server_url.'/api/v1/dot_subdepartment.php?id='.$id)
            ->get();
        }else  if(!empty($deptID)){
            $response = Curl::to($this->server_url.'/api/v1/dot_subdepartment.php?deptID='.$deptID)
            ->get();
        }else  if(!empty($keyword)){
            $response = Curl::to($this->server_url.'/api/v1/dot_subdepartment.php?keyword='.$keyword)
            ->get();
        }else{
              $response = Curl::to($this->server_url.'/api/v1/dot_subdepartment.php')
            ->get();
        }
        $json = json_decode($response, true);
        return $json;
       
    }

    private function apiDotPersonel($id='',$deptID='',$subdeptID='',$name=''){
        $response = array();
        if(!empty($name)){
            $response = Curl::to($this->server_url.'/api/v1/dot_personel.php?name='.$name)
            ->get();
        }else if(!empty($id)){
             $response = Curl::to($this->server_url.'/api/v1/dot_personel.php?id='.$id)
            ->get();
        }else if(!empty($deptID)){
             $response = Curl::to($this->server_url.'/api/v1/dot_personel.php?deptID='.$deptID)
            ->get();
        }else if(!empty($subdeptID)){
            $response = Curl::to($this->server_url.'/api/v1/dot_personel.php?subdeptID='.$subdeptID)
            ->get();
        }else{
            $response = Curl::to($this->server_url.'/api/v1/dot_personel.php')
            ->get();
        }
        $json = json_decode($response, true);
        return $json;

    }


}
