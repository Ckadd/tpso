<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class MissionAndAuthority extends Model
{
    /**
     * Relation with table missionAuthorityView.
     *
     * @return App\Model\MissionAndAuthorityView
     */
    public function missionAuthorityView()
    {
        return $this->hasMany('App\Model\MissionAndAuthorityView','mission_authority_id','id');
    }
}
