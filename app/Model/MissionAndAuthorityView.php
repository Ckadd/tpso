<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class MissionAndAuthorityView extends Model
{
    /**
     * Relation with table missionAuthority.
     *
     * @return App\Model\MissionAuthority
     */
    public function missionAuthority()
    {
        return $this->belongTo('App\Model\MissionAndAuthority','mission_authority_id','id');
    }
}
