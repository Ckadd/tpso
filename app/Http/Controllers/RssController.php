<?php

namespace App\Http\Controllers;

use Laravelium\Feed\Feed;
use DB;
use Request;
use App;
use App\Model\TourStandard;
use App\Model\PublicGuide;
use App\Model\LibraryBook;
use App\Model\LandmarkStandard;
use App\Model\Knowledgebase;
use App\Model\ContentSharing;
use App\Model\AnnualBudgetCategory;
use App\Model\AnnualBudget;
use App\Model\News;
use App\Model\Page;
use App\Model\JobPosting;
use App\Model\MappingLang;
use App\Model\CalendarDetail;

class RssController extends Controller
{
    private $feed;

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    public function new_inform($lang)
    {
        $datas = $this->sqlGetNew(1,$lang);
        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->cover_image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];
            $this->feed->add(
                $data->title,
                '',
                url('news/inform/detail/' . $data->id),
                $data->created_at,
                $data->short_description,
                '',
                (!empty($data->cover_image))? $enclosure : $enclosure_fix
            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');
    }

    public function new_institution($lang)
    {
        $datas = $this->sqlGetNew(2,$lang);
        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->cover_image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];
            $this->feed->add(
                $data->title,
                '',
                url('news/institution/detail/' . $data->id),
                $data->created_at,
                $data->short_description,
                '',
                (!empty($data->cover_image))? $enclosure : $enclosure_fix
            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');
    }

    public function new_manager($lang)
    {
        $datas = $this->sqlGetNew(3,$lang);
        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->cover_image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];
            $this->feed->add(
                $data->title,
                '',
                url('news/manager/detail/' . $data->id),
                $data->created_at,
                $data->short_description,
                '',
                (!empty($data->cover_image))? $enclosure : $enclosure_fix
            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');
    }

    public function new_procurement($lang)
    {
        $datas = $this->sqlGetNew(3,$lang);
        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->cover_image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];
            $this->feed->add(
                $data->title,
                '',
                url('news/procurement/detail/' . $data->id),
                $data->created_at,
                $data->short_description,
                '',
                (!empty($data->cover_image))? $enclosure : $enclosure_fix
            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');
    }

    public function new_jobPosting($lang)
    {
        $datas = JobPosting::orderBy('created_at', 'desc')->take(20)->get();
        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];

            $this->feed->add(
                $data->title,
                '' .
                url('job-post/detail/' . $data->id),
                $data->datetime,
                $data->full_description,
                '',
                (!empty($data->image))? $enclosure : $enclosure_fix

            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');
    }

    public function new_calendar($lang)
    {
        //$datas = CalendarDetail::orderBy('created_at', 'desc')->take(20)->get();
        $datas = CalendarDetail::leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', $lang)
            ->where('mapping_langs.module', 'calendar-details')
            ->select('calendar_details.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('calendar_details.created_at', 'desc')
            ->take(20)
            ->get();
        if(count($datas) <= 0){
            $datas = CalendarDetail::leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'calendar-details')
                ->select('calendar_details.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('calendar_details.created_at', 'desc')
                ->take(20)
                ->get();
        }
        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->cover_image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];
            $this->feed->add(
                $data->title,
                '' ,
                url('job-post/detail/' . $data->id),
                $data->datetime,
                $data->short_description,
                '',
                (!empty($data->cover_image)) ? $enclosure : $enclosure_fix
            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');
    }

    public function contentSharing($lang)
    {
        //$datas = ContentSharing::orderBy('created_at', 'desc')->take(20)->get();
        $datas = ContentSharing::leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', $lang)
            ->where('mapping_langs.module', 'content-sharings')
            ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('content_sharings.created_at', 'desc')
            ->take(20)
            ->get();
        if(count($datas) <= 0){
            $datas = ContentSharing::leftJoin('mapping_langs', 'content_sharings.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'content-sharings')
                ->select('content_sharings.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('content_sharings.created_at', 'desc')
                ->take(20)
                ->get();
        }

        foreach ($datas as $data) {
            $enclosure = ['url' => asset('storage/' . $data->cover_image), 'type' => 'image/jpeg'];
            $enclosure_fix = ['url' => url('themes/dot/assets/images/default_img.png'), 'type' => 'image/jpeg'];
            $this->feed->add(
                $data->title,
                '',
                url('content-sharing/content-sharing-detail/' . $data->id),
                $data->created_at,
                $data->short_description,
                '',
                (!empty($data->cover_image))? $enclosure : $enclosure_fix
            );
        }
        return $this->feed->render('rss')->header('Content-Type', 'application/xml');

    }

    private function sqlGetNew($cate_id,$lang)
    {
        //App::getLocale()
        $dataArr = News::leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', $lang)
            ->where('mapping_langs.module', 'news')
            ->where('news.category_id', $cate_id)
            ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
            ->orderBy('news.created_at', 'desc')
            ->take(20)
            ->get();
        if(count($dataArr) <= 0){
            $dataArr = News::leftJoin('mapping_langs', 'news.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'news')
                ->where('news.category_id', $cate_id)
                ->select('news.*', 'mapping_langs.code_lang','mapping_langs.master_id','mapping_langs.parent_id')
                ->orderBy('news.created_at', 'desc')
                ->take(20)
                ->get();
        }
        return $dataArr;

    }

}
