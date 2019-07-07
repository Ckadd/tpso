<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Repository\LibraryViewRepository;
use App\Service\ThemeService;
use Theme;

class LibraryViewController extends VoyagerBaseController
{
    protected $themeService;
    protected $libraryViewRepository;
    public function __construct(
        ThemeService $themeService,
        LibraryViewRepository $libraryViewRepository
    ) {
        $this->themeService = $themeService;
        $this->libraryViewRepository = $libraryViewRepository;
        Theme::set($this->themeService->getCurrentTheme());
    }

    public function contentDetail(int $id) 
    {
        $this->libraryViewRepository->listDataById($id);
    }
}
