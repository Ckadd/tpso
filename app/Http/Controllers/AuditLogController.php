<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\AuditLogRepository;

class AuditLogController extends Controller
{
    protected $auditLogRepository;

    public function __construct(AuditLogRepository $auditLogRepository)
    {
        $this->auditLogRepository = $auditLogRepository;
    }
    //
    public function getModule(Request $request, string $module)
    {
        if(!empty($module)) {
            $queryModule = $this->auditLogRepository->listActionByModule($module);
            $data['moduleLog'] = $queryModule;
            $data['type'] = $module;

            return view('vendor.voyager.audit-logs.read',$data);
        }
    }
}
