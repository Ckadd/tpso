<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class CalendarCategory extends Model
{
    /**
     * Relation with table calendarDetail.
     *
     * @return void
     */
    public function calendarDetail()
    {
        return $this->hasMany('App\Model\CalendarDetail','carlendar_id', 'id');
    }
}
