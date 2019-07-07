<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use Theme;

class SearchController extends VoyagerBaseController
{

    protected $client;

    public function __construct(
        \Solarium\Client $client, 
        ThemeService $themeService
    )
    {
        $this->client = $client;
        $this->themeService = $themeService;
        Theme::set($this->themeService->getCurrentTheme());
    }
    /**
     * Search index 
     * 
     */
    public function indexSearch(Request $Request)
    {
        $start = 0;
        $count_per_page = 10;
        $current_page = ($Request->query('page')) ? $Request->query('page') : 1;
        $start = ($current_page - 1) * $count_per_page;
        $q = $Request->query('q');


        // init query
        $query = $this->client->createSelect();
        $query->setQuery('*:*');
        $query->setQuery("title:*{$q}* or excerpt:*{$q}* or body:*{$q}*");
        // $query->setQuery("excerpt:*{$q}*");
        $query->setStart($start);
        $query->setRows($count_per_page);

        // get results
        $resultset = $this->client->select($query);

        // get num found
        $num_found = $resultset->getNumFound();

        // get max_page
        $max_pages = intval(ceil($num_found / $count_per_page));

        $results = array();
        foreach($resultset as $document) {
            $item = array();
            foreach($document as $field => $value) {
                $item[$field] = $value;
            }
            $results[] = $item;
        }

        return view('search', compact('q', 'results', 'num_found', 'max_pages', 'current_page', 'count_per_page'));

    }
    
}