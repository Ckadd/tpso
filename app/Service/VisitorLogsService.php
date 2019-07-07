<?php

namespace App\Service;

class VisitorLogsService {

    /**
     * get count logs all views
     *
     * @return void
     */
    public static function getCountLogs() 
    {
        $visitorLogsRepository = app()->make('App\Repository\VisitorLogsRepository');
        $data = $visitorLogsRepository->getCountLogs();
        
        return $data;
    }

    public static function getLogsToday()
    {
        $visitorLogsRepository = app()->make('App\Repository\VisitorLogsRepository');
        $data = $visitorLogsRepository->getLogsToday();
        
        return $data;
    }
}