<?php

namespace App\Repository;

use App\Model\BannerView;
use Carbon\Carbon;

class BannerViewRepository {
    protected $bannerModel;

    function __construct(BannerView $bannerModel)
    {
        $this->bannerModel = $bannerModel;
    }

    public function addLogCounterById(int $id,$title,$bannerType) {

        return  $this->bannerModel->insert([
                    'banner_id'   => $id,
                    'ip'          => $_SERVER['REMOTE_ADDR'],
                    'type'        => $title,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                    'banner_type' => $bannerType
                ]);
        
    }
}