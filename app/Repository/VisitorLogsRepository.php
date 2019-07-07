<?php

namespace App\Repository;

use App\Model\VisitorLog;
use Illuminate\Cache\Events\CacheHit;
use Carbon\Carbon;

class VisitorLogsRepository {
    protected $visitorLogModel;
    
    public function __construct(
        VisitorLog $visitorLogModel
    )
    {
        $this->visitorLogModel = $visitorLogModel;
    }

    public function addLogDot() {
       
        $ip  = $_SERVER['REMOTE_ADDR'];
        $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

        $checkIpAddress = $this->visitorLogModel->where('ip',$ip)
        ->whereDate('datetime',date('Y-m-d'))
        ->where('url',$url)
        ->first();
        
        if(!empty($checkIpAddress)) {
            $id = $checkIpAddress['id'];
            $this->visitorLogModel->where('id',$id)
            ->update([
                'datetime' => Carbon::now()
            ]);

        }else {

            $this->visitorLogModel->insert([
                'ip' => $ip,
                'url' => $url,
                'type' => 'Dot',
                'group' => 'Guest',
                'datetime' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()    
            ]);
        }
        
    }

    public function getCountLogs() {
        return $this->visitorLogModel->select('*')->count();   
    }

    public function getLogsToday() {
       
        $data = $this->visitorLogModel::whereDate('datetime',Carbon::today())->count();
        
        return $data;
    }
}