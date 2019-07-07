<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;

class ChartCategoryController extends VoyagerBaseController
{
    /**
     * add user create to backend voyager
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->request->add(['create_by' => auth()->user()->id]);

        return parent::store($request);
    }
}
