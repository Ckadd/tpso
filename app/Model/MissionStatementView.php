<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class MissionStatementView extends Model
{
    /**
     * Relation with table missionstatement.
     *
     * @return App\Model\missionstatement
     */
    public function missionstatement()
    {
        return $this->belongTo('App\Model\MissionStatement','mission_id','id');
    }
}
