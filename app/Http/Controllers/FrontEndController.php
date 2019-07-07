<?php

namespace App\Http\Controllers;

use App\Service\ThemeService;
use Theme;
use App\Repository\BannerRepository;
use App\Repository\ChartStatisticRepository;
use App\Repository\GalleryCategoryRepository;
use App\Repository\ArticleRepository;
use App\Repository\PostRepository;
use App\Repository\NewsCategoryRepository;
use App\Repository\PageRepository;
use App\Repository\ContentSharingRepository;
use App\Repository\ServiceListRepository;
use DateTime;
use App\Repository\VisitorLogsRepository;
use App;
use App\Repository\JobPostingRepository;
class FrontEndController extends Controller
{
    protected $themeService;
    protected $bannerRepository;
    protected $chartStatisticRepository;
    protected $galleryCategoryRepository;
    protected $articleRepository;
    protected $postRepository;
    protected $newsRepository;
    protected $pagesTourismRepository;
    protected $contentSharingRepository;
    protected $serviceListRepository;
    protected $visitorLogsRepository;
    protected $jobPostRepository;

    public function __construct(
        ThemeService $themeService,
        BannerRepository $bannerRepository,
        ChartStatisticRepository $chartStatisticRepository,
        GalleryCategoryRepository $galleryCategoryRepository,
        ArticleRepository $articleRepository,
        PostRepository $postRepository,
        NewsCategoryRepository $newsRepository,
        PageRepository $pagesTourismRepository,
        ContentSharingRepository $contentSharingRepository,
        ServiceListRepository $serviceListRepository,
        VisitorLogsRepository $visitorLogsRepository,
        JobPostingRepository $jobPostRepository
    ) {
        $this->themeService = $themeService;
        $this->bannerRepository = $bannerRepository;
        $this->chartStatisticRepository = $chartStatisticRepository;
        $this->galleryCategoryRepository = $galleryCategoryRepository;
        $this->articleRepository = $articleRepository;
        $this->postRepository = $postRepository;
        $this->newsRepository = $newsRepository;
        $this->pagesTourismRepository = $pagesTourismRepository;
        $this->contentSharingRepository = $contentSharingRepository;
        $this->serviceListRepository = $serviceListRepository;
        $this->visitorLogsRepository = $visitorLogsRepository;
        $this->jobPostRepository = $jobPostRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    /**
     * Index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pageIntro = $this->pagesTourismRepository->listIntroPage();
        
        if(!empty($pageIntro)) {
            
            return redirect('/pages/'.$pageIntro[0]['id']);
        }

        $statistic = $this->chartStatisticRepository->listdata();
        $banner = $this->bannerRepository->listdata();
        $data['gallery'] = $this->galleryCategoryRepository->listCategoryHomepage();
        $postFooter = $this->postRepository->listPostFooter();
        $postPermission = $this->postRepository->listPostPermissionIndex();
        $postVerifyLicense = $this->postRepository->listPostVerifyLicenseIndex();
        $categoryLastNews = $this->newsRepository->listNewsPostLastContent();
        $contentSharing = $this->contentSharingRepository->listdataFontend();
        $service = $this->serviceListRepository->listService();
        $getDateNow = date('Y-m-d');
        $datenow =  explode(" ",date("d F Y", strtotime($getDateNow)));
        if(App::getLocale() == 'th'){
            $datenow = $this->DateThai($getDateNow);
        }
        $lastJobPost['ข่าวรับสมัครงาน'] = $this->jobPostRepository->lastContent();
        
        // merge new and jobpost
        $mergeNew = array_merge($categoryLastNews,$lastJobPost);
        
        // get date in statistic
        $newStatistic = [];
        foreach($statistic as $keyStatistic => $valueStatistic) {
            $explodeDateStatistic = explode(' ',$valueStatistic['datetime']);
            $dateChange = $this->DateThai($explodeDateStatistic[0]);
            $dateStatistic['dateChange'] = $mergeDateChange = $dateChange[0]." ".$dateChange[1]." ".$dateChange[2];
            $newStatistic[] = array_merge($valueStatistic,$dateStatistic);
        }

        $newAll = [];
        foreach($mergeNew as $keyNew => $valueNew) {
            if(!empty($valueNew)) {
                $explodeDateNew = explode(' ',$valueNew[0]['datetime']);
                $dateChangeNew = $this->DateThai($explodeDateNew[0]);            
                $dateNews['dateChange'] = $mergeDateChange = $dateChangeNew[0]." ".$dateChangeNew[1]." ".$dateChange[2];
                $newAll[$keyNew] = array_merge($valueNew,$dateNews);
            }else {
                $newAll[$keyNew] = $valueNew;
            }
        }
       
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        $data['statistic'] = $newStatistic;
        $data['banner'] = $banner;
        $data['postFooter'] = $postFooter;
        $data['lastPostNews'] = $newAll;
        $data['postPermission'] = $postPermission;
        $data['postVerifyLicense'] = $postVerifyLicense;
        $data['contentSharing'] = $contentSharing;
        $data['datenow'] = $datenow;
        $data['service'] = $service;

        return view('index',$data);
    }

    public function index2()
    {
        
        $statistic = $this->chartStatisticRepository->listdata();
        $banner = $this->bannerRepository->listdata();
        $data['gallery'] = $this->galleryCategoryRepository->listCategoryHomepage();
        $postFooter = $this->postRepository->listPostFooter();
        $postPermission = $this->postRepository->listPostPermissionIndex();
        $postVerifyLicense = $this->postRepository->listPostVerifyLicenseIndex();        
        $categoryLastNews = $this->newsRepository->listNewsPostLastContent();
        $contentSharing = $this->contentSharingRepository->listdataFontend();
        $service = $this->serviceListRepository->listService();
        $getDateNow = date('Y-m-d');
        $datenow =  explode(" ",date("d F Y", strtotime($getDateNow)));
        
        if(App::getLocale() == 'th'){
            $datenow = $this->DateThai($getDateNow);
        }
        $lastJobPost['ข่าวรับสมัครงาน'] = $this->jobPostRepository->lastContent();

        // merge new and jobpost
        $mergeNew = array_merge($categoryLastNews,$lastJobPost);
        
        // get date in statistic
        $newStatistic = [];
        foreach($statistic as $keyStatistic => $valueStatistic) {
            $explodeDateStatistic = explode(' ',$valueStatistic['datetime']);
            $dateChange = $this->DateThai($explodeDateStatistic[0]);
            $dateStatistic['dateChange'] = $mergeDateChange = $dateChange[0]." ".$dateChange[1]." ".$dateChange[2];
            $newStatistic[] = array_merge($valueStatistic,$dateStatistic);
        }

        $newAll = [];
        foreach($mergeNew as $keyNew => $valueNew) {
            if(!empty($valueNew)) {
                $explodeDateNew = explode(' ',$valueNew[0]['datetime']);
                $dateChangeNew = $this->DateThai($explodeDateNew[0]);            
                $dateNews['dateChange'] = $mergeDateChange = $dateChangeNew[0]." ".$dateChangeNew[1]." ".$dateChange[2];
                $newAll[$keyNew] = array_merge($valueNew,$dateNews);
            }else {
                $newAll[$keyNew] = $valueNew;
            }
        }
       
        /**
         * log visitWebsite
         */
        $this->visitorLogsRepository->addLogDot();
        
        $data['statistic'] = $newStatistic;
        $data['banner'] = $banner;
        $data['postFooter'] = $postFooter;
        $data['lastPostNews'] = $newAll;
        $data['postPermission'] = $postPermission;
        $data['postVerifyLicense'] = $postVerifyLicense;
        $data['contentSharing'] = $contentSharing;
        $data['datenow'] = $datenow;
        $data['service'] = $service;

        return view('index',$data);
    }


    private function DateThai($strDate)
    {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];

        return array($strDay,$strMonthThai,$strYear);
    }
}
