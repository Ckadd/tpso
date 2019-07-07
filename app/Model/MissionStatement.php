<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class MissionStatement extends Model
{
    /**
     * Relation with table missionstatementView.
     *
     * @return App\Model\missionstatementView
     */
    public function missionstatementView()
    {
        return $this->hasMany('App\Model\MissionStatementView','mission_id','id');
    }
}
