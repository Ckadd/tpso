<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;
use App\Service\ThemeService;
use Theme;

use App\Repository\FeedRepository;

class FeedController extends VoyagerBaseController
{
    protected $feedRepository;

    public function __construct(
        ThemeService $themeService,
        FeedRepository $feedRepository

    ) {
        $this->themeService = $themeService;
        $this->feedRepository = $feedRepository;

        Theme::set($this->themeService->getCurrentTheme());
    }

    public function action_index(){
      //
    }

    public  function  action_byId(Request $request,$id){
        //
    }
}
