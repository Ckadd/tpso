<?php

namespace App\Repository;
use Illuminate\Http\Request;
use App\model\AuditLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use App\Service\PaginateService;
class AuditLogRepository { 

    protected $auditLogModel;

    public function __construct(AuditLog $auditLogModel) { 
        $this->auditLogModel = $auditLogModel;
    }

    public function addLog(string $userName,string $action,string $module) { 
        
        $this->auditLogModel->insert([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_name'  => $userName,
            'action'   => $action,
            'datetime' => Carbon::now(),
            'module'   => $module,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function listActions() {
        $data = $this->auditLogModel->select('action')
        ->distinct('action')->get();

        return $data;
    }

    public function listId() {
        $action = ['view'];
        $allId = [];
        foreach($action as $key => $val) {
            $allId[] = $this->auditLogModel->select('*')
            ->where('action',$val)->first();
        }
        return $allId;
        
    }

    public function listLogView() {

        return $this->auditLogModel->select('*')
        ->where('action','view')->orderBy('id','DESC')->paginate(20);
    }

    public function listLogCreate() {

        return $this->auditLogModel->select('*')
        ->where('action','create')->orderBy('id','DESC')->paginate(20);
    }

    public function listLogUpdate() {

        return $this->auditLogModel->select('*')
        ->where('action','update')->orderBy('id','DESC')->paginate(20);
    }

    public function listLogDelete() {

        return $this->auditLogModel->select('*')
        ->where('action','delete')->orderBy('id','DESC')->paginate(20);
    }

    public function listModule() {
        
        $data = $this->auditLogModel->select('module')
        ->orderBy('module','ASC')
        ->distinct()
        ->get()->toArray();

        return $data;
    }

    public function listActionByModule(string $name) {
        
        $data = $this->auditLogModel->select('*')
        ->where('module',$name)
        ->orderBy('action','ASC')
        ->paginate(20);

        return $data;
    }
}