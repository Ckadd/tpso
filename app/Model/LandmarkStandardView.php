<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LandmarkStandardView extends Model
{
    public function landmarkStandard()
    {
        return $this->belongsTo('App\Model\LandmarkStandard');
    }
}
