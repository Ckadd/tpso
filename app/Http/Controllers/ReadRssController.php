<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;
use App\Repository\FeedRepository;
use Feeds;

class ReadRssController extends VoyagerBaseController
{
    protected $themeService;

    public function __construct(
        ThemeService $themeService,
        FeedRepository $feedRepository
    )
    {
        $this->themeService = $themeService;
        $this->feedRepository = $feedRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    public  function  getById($id){
        $res = $this->feedRepository->getById($id);
        if(!empty($res) and !empty($res->url)){
            $feed_url = $res->url;
            $content = file_get_contents($feed_url); // get XML string
            $data = new \SimpleXmlElement($content); // load XML string into object
            return view('reader-feed-list', compact('data','res'));
        }
        abort(404);

    }

    public function readRssList(){
        $rss_url_get =  Request::input('src');
        $lang =  Request::input('lang');
        $module =  Request::input('module');

        if(!empty($rss_url_get) && !empty($lang)){
            $st_1 = explode(".",$rss_url_get);
            $st_2 = explode("-",$st_1[0]);
            if(count($st_2) > 1){
                $str = $st_2[0].' '.$st_2[1];
            }else{
                $str = $st_2[0];
            }

            $rss_url = url('rss/'.$lang.'/'.$rss_url_get);
            if(!empty($module)){
                $rss_url = url('rss/'.$lang.'/'.$module.'/'.$rss_url_get);
            }

            return view('reader-rss-list', compact('rss_url','str'));
        }
        abort(404);
    }

    public function readRssThumb(){
        $rss_url_get =  Request::input('src');
        $lang =  Request::input('lang');
        $module =  Request::input('module');

        if(!empty($rss_url_get) && !empty($lang)){
            $st_1 = explode(".",$rss_url_get);
            $st_2 = explode("-",$st_1[0]);
            if(count($st_2) > 1){
                $str = $st_2[0].' '.$st_2[1];
            }else{
                $str = $st_2[0];
            }

            $rss_url = url('rss/'.$lang.'/'.$rss_url_get);
            if(!empty($module)){
                $rss_url = url('rss/'.$lang.'/'.$module.'/'.$rss_url_get);
            }
            return view('reader-rss-thumb', compact('rss_url','str'));
        }
        abort(404);
    }
}


