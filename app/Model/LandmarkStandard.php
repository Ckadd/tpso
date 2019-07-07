<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LandmarkStandard extends Model
{
    public function landmarkStandardView()
    {
        return $this->hasMany('App\Model\LandmarkStandardView','landmark_standard_id','id');
    }
}
