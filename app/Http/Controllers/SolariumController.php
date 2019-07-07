<?php

namespace App\Http\Controllers;

use DateTime;
use App\Model\Faq;
use App\Model\News;
use App\Model\Page;
use App\Model\Ebook;
use App\Model\Strategic;
use App\Model\TravelTip;
use App\Model\JobPosting;
use App\Model\LibraryBook;
use App\Model\PublicGuide;
use App\Model\AnnualBudget;
use App\Model\FormDownload;
use App\Model\NewsCategory;
use App\Model\TourStandard;
use App\Model\Knowledgebase;
use App\Model\OrganizeChart;
use Illuminate\Http\Request;
use App\Model\CalendarDetail;
use App\Model\ContentSharing;
use App\Model\LawsRegulation;
use App\Model\LandmarkStandard;
use App\Model\MissionStatement;
use App\Model\MissionAndAuthority;
use App\Model\StandardTourismPersonnel;

/**
 * This controller for generate index on solr
 * 
 */
class SolariumController extends Controller
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Test ping to solr
     */
    public function ping()
    {
        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $this->client->ping($ping);
            return response()->json('OK');
        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }

    public function reIndex() {
        $datas = array();

        // get an update query instance
        $update = $this->client->createUpdate();

        $contentSharingIndex = $this->setupContentSharing($update);
        $pageIndex = $this->setupPage($update);
        $annualBudgetIndex = $this->setupAnnualBudget($update);
        $calendarDetailIndex = $this->setupCalendarDetail($update);
        $ebookIndex = $this->setupEbook($update);
        $faqIndex = $this->setupFaq($update);
        $formDownloadIndex = $this->setupFormDownload($update);
        $jobPostingIndex = $this->setupJobPosting($update);
        $knowledgebaseIndex = $this->setupKnowledgebase($update);
        $landmarkStandardIndex = $this->setupLandmarkStandard($update);
        $lawsRegulationIndex = $this->setupLawsRegulation($update);
        $libraryBookIndex = $this->setupLibraryBook($update);
        $missionAndAuthorityIndex = $this->setupMissionAndAuthority($update);
        $missionStatementIndex = $this->setupMissionStatement($update);
        $publicGuideIndex = $this->setupPublicGuide($update);
        $standardTourismPersonnelIndex = $this->setupStandardTourismPersonnel($update);
        $strategicIndex = $this->setupStrategic($update);
        $tourStandardIndex = $this->setupTourStandard($update);
        $travelTipIndex = $this->setupTravelTip($update);
        $newsIndex = $this->setupNews($update);
        $organizeChartIndex = $this->setupOrganizeChart($update);

        $datas = array_merge(
            $contentSharingIndex, 
            $pageIndex, 
            $annualBudgetIndex, 
            $calendarDetailIndex, 
            $ebookIndex,
            $faqIndex,
            $formDownloadIndex,
            $jobPostingIndex,
            $knowledgebaseIndex,
            $landmarkStandardIndex,
            $lawsRegulationIndex,
            $libraryBookIndex,
            $missionAndAuthorityIndex,
            $missionStatementIndex,
            $publicGuideIndex,
            $standardTourismPersonnelIndex,
            $strategicIndex,
            $tourStandardIndex,
            $travelTipIndex,
            $newsIndex,
            $organizeChartIndex
        );

        $update->addDocuments($datas);
        $update->addCommit();

        $result = $this->client->update($update);

        $date = new DateTime();
        $now_date = $date->format('Y-m-d H:i:s');

        echo "<b>Update query executed</b><br/>";
        echo "Date : {$now_date} <br/>";
        echo "Indexed : ".count($datas)." items<br/>";
        echo "Query status: {$result->getStatus()}<br/>";
        echo "Query time: {$result->getQueryTime()}<br/>";
        echo "=====================<br/>";
        foreach ($datas as $i => $data) {
            $count = $i+1;
            echo "{$count}. [{$data->getFields()['cat']}] {$data->getFields()['title']} : {$data->getFields()['url']}<br/>";
        }
        die();
    }

    /**
     * Delete solr data by category
     * 
     * @param   string  $cat
     */
    public function deleteSolrContentByCat($cat) {
        $update = $this->client->createUpdate();

        // add the delete query and a commit command to the update query
        $update->addDeleteQuery("cat:{$cat}");
        $update->addCommit();

        // this executes the query and returns the result
        $result = $this->client->update($update);
    }

    /**
     * Setup index for ContentSharing
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupContentSharing($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "ContentSharing";
        $this->deleteSolrContentByCat($category);

        $contents = ContentSharing::where('status', 1)->get();
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('sharing.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for Pge
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupPage($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "Page";
        $this->deleteSolrContentByCat($category);

        $contents = Page::where('status', "ACTIVE")->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('pages.data', ['id' => $content->id]);
            $d->excerpt = ($content->excerpt) ? $content->excerpt : " ";
            $d->body = ($content->body) ? $content->body : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for AnnualBudget
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupAnnualBudget($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "AnnualBudget";
        $this->deleteSolrContentByCat($category);

        $contents = AnnualBudget::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('annualbudget.download', ['id' => $content->id]);
            $d->excerpt = " ";
            $d->body = " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for AnnualBudget
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupCalendarDetail($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "CalendarDetail";
        $this->deleteSolrContentByCat($category);

        $contents = CalendarDetail::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('calendar.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for Ebook
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupEbook($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "Ebook";
        $this->deleteSolrContentByCat($category);

        $contents = Ebook::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->name;
            $d->url = route('ebooks.view', ['id' => $content->id]);
            $d->excerpt = " ";
            $d->body = " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for Faq
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupFaq($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "Faq";
        $this->deleteSolrContentByCat($category);

        $contents = Faq::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('faq.view');
            $d->excerpt = " ";
            $d->body = ($content->content) ? $content->content : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for FormDownload
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupFormDownload($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "FormDownload";
        $this->deleteSolrContentByCat($category);

        $contents = FormDownload::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('formdownload.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for Job Posting
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupJobPosting($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "JobPosting";
        $this->deleteSolrContentByCat($category);

        $contents = JobPosting::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('job.detail', ['id' => $content->id]);
            $d->excerpt = " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for Knowledgebase
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupKnowledgebase($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "Knowledgebase";
        $this->deleteSolrContentByCat($category);

        $contents = Knowledgebase::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('knowledgebase.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for LandmarkStandard
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupLandmarkStandard($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "LandmarkStandard";
        $this->deleteSolrContentByCat($category);

        $contents = LandmarkStandard::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('landmarkstandard.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for LawsRegulation
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupLawsRegulation($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "LawsRegulation";
        $this->deleteSolrContentByCat($category);

        $contents = LawsRegulation::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('laws.detail', ['id' => $content->id]);
            $d->excerpt = " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for LibraryBook
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupLibraryBook($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "LibraryBook";
        $this->deleteSolrContentByCat($category);

        $contents = LibraryBook::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('librarybook.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for MissionAndAuthority
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupMissionAndAuthority($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "MissionAndAuthority";
        $this->deleteSolrContentByCat($category);

        $contents = MissionAndAuthority::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('MissionAuthority.view');
            $d->excerpt = " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for MissionStatement
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupMissionStatement($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "MissionStatement";
        $this->deleteSolrContentByCat($category);

        $contents = MissionStatement::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('mission.view');
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for PublicGuide
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupPublicGuide($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "PublicGuide";
        $this->deleteSolrContentByCat($category);

        $contents = PublicGuide::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('publicguide.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for StandardTourismPersonnel
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupStandardTourismPersonnel($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "StandardTourismPersonnel";
        $this->deleteSolrContentByCat($category);

        $contents = StandardTourismPersonnel::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('StandardTourismPersonnel.view');
            $d->excerpt = " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for Strategic
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupStrategic($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "Strategic";
        $this->deleteSolrContentByCat($category);

        $contents = Strategic::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('strategic.view');
            $d->excerpt = " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for TourStandard
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupTourStandard($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "TourStandard";
        $this->deleteSolrContentByCat($category);

        $contents = TourStandard::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('tourstandard.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for TravelTip
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupTravelTip($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "TravelTip";
        $this->deleteSolrContentByCat($category);

        $contents = TravelTip::where('status', 1)->get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = $content->title;
            $d->url = route('traveltip.detail', ['id' => $content->id]);
            $d->excerpt = ($content->short_description) ? $content->short_description : " ";
            $d->body = ($content->full_description) ? $content->full_description : " ";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for OrganizeChart
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupOrganizeChart($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "OrganizeChart";
        $this->deleteSolrContentByCat($category);

        $contents = OrganizeChart::get();
        // dd($contents);
        foreach($contents as $content) {
            // create a new document for the data
            $d = $update->createDocument();
            $d->id = "{$category}_" . $content->id;
            $d->title = "{$content->first_name} {$content->last_name} - {$content->position}";
            $d->url = route('organizechart.detail', ['id' => $content->id]);
            $d->excerpt = " ";
            $d->body = "{$content->contact} {$content->education_history} {$content->work_history} {$content->train_history} {$content->insignia_history}";

            $d->lang = "TH";
            $d->cat = $category;

            array_push($datas, $d);
        }

        return $datas;
    }

    /**
     * Setup index for News
     * 
     * @param   object  $update
     * @return  array   
     */
    public function setupNews($update) {
        $datas = array();

        // add the delete query and a commit command to the update query
        $category = "News";
        $this->deleteSolrContentByCat($category);

        $newsCats = NewsCategory::get();

        foreach($newsCats as $newsCat) {
            foreach($newsCat->getNews as $content) {
                // create a new document for the data
                $d = $update->createDocument();
                $d->id = "{$category}_" . $content->id;
                $d->title = $content->title;

                $d->url = "#";
                if ($newsCat->name == 'ข่าวประชาสัมพันธ์') {
                    $d->url = route('news.inform.detail', ['id' => $content->id]);
                } elseif ($newsCat->name == 'ข่าวหน่วยงาน') {
                    $d->url = route('news.institution.detail', ['id' => $content->id]);
                } elseif ($newsCat->name == 'ข่าวผู้บริหาร') {
                    $d->url = route('news.manager.detail', ['id' => $content->id]);
                } elseif ($newsCat->name == 'ข่าวจัดซื้อจัดจ้าง') {
                    $d->url = route('news.procurement.detail', ['id' => $content->id]);
                }

                $d->excerpt = ($content->short_description) ? $content->short_description : " ";
                $d->body = ($content->full_desscription) ? $content->full_desscription : " ";

                $d->lang = "TH";
                $d->cat = $category;

                array_push($datas, $d);
            }
        }

        return $datas;
    }
}
