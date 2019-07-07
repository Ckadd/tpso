<?php

namespace App\Service;

use Illuminate\Http\Request;
class AuditLogService 
{
    /**
     * list data all relation from auditlog.
     *
     * @param mixed $id
     *
     * @return array
     */
    public static function listActions() 
    {
        $auditlogRepository = app()->make('App\Repository\AuditLogRepository');
        
        return $auditlogRepository->listActions();
    }

    public static function listId() 
    {
        $auditlogRepository = app()->make('App\Repository\AuditLogRepository');
        
        return $auditlogRepository->listId();
    }

    public static function listLogView()
    {
        $auditlogRepository = app()->make('App\Repository\AuditLogRepository');
        
        return $auditlogRepository->listLogView();
    }

    public static function listLogCreate()
    {
        $auditlogRepository = app()->make('App\Repository\AuditLogRepository');
        
        return $auditlogRepository->listLogCreate();
    }

    public static function listLogUpdate()
    {
        $auditlogRepository = app()->make('App\Repository\AuditLogRepository');
        
        return $auditlogRepository->listLogUpdate();
    }

    public static function listLogDelete()
    {
        $auditlogRepository = app()->make('App\Repository\AuditLogRepository');
        
        return $auditlogRepository->listLogDelete();
    }

    public static function listModule()
    {
        $auditlogRepositoy = app()->make('App\Repository\AuditLogRepository');

        return $auditlogRepositoy->listModule();
    }
}