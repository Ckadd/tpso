<?php

namespace App\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;


class PaginateService {

    public static function getPaginate(array $data,int $perPage,Request $request) {
        
        // ---------paginate---------
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        // Create a new Laravel collection from the array data
        $itemCollection = collect($data);
        
        // Define how many items we want to be visible in each page
        $perPage = $perPage;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        
        // set url path for generted links
        $paginatedItems->setPath($request->url());
        
        return $paginatedItems;
        // ---------End paginate---------
    }
}