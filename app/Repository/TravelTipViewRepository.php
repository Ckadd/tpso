<?php 

namespace App\Repository;
use App\Model\TravelTipView;

class TravelTipViewRepository {
    
    protected $travelTipViewRepository;

    public function __construct(TravelTipView $travelTipViewRepository) {
        $this->travelTipViewRepository = $travelTipViewRepository;
    }

    public function addlogByViewPage($id){
        try{
            return $this->travelTipViewRepository->insert([
                    'travel_tip_id' => $id,
                    'ip'         => $_SERVER['REMOTE_ADDR'],
                    'type'       => 'view',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function addlogByShareSocialPage(int $id,string $type){ 
        try{
            return $this->travelTipViewRepository->insert([
                    'travel_tip_id' => $id,
                    'ip'         => $_SERVER['REMOTE_ADDR'],
                    'type'       => $type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogView() {
        try{
            $contentId = $this->travelTipViewRepository->select('travel_tip_id')
            ->distinct()
            ->get()
            ->toArray();
            $mergeContentId = [];
            foreach($contentId as $val) { 
                $mergeContentId[$val['travel_tip_id']] = $this->travelTipViewRepository
                ->select('id')
                ->where('travel_tip_id',$val['travel_tip_id'])
                ->where('type','view')
                ->count();
            }
            return $mergeContentId;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    public function listAllLogById($id) {
        try{
            $type = ['view','facebook','twitter','googleplus'];
            
            foreach($type as $val) { 
                $allLog[$val] = $this->travelTipViewRepository
                ->select('id')
                ->where('travel_tip_id',$id)
                ->where('type',$val)
                ->count();
            }
            $newAllLog['social']=$allLog;
            return $newAllLog;
        }catch(ModelNotFoundException $e){
            return [];
        }
    }

    
}