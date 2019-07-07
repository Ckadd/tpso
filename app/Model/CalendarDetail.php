<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class CalendarDetail extends Model
{
    /**
     * relation belong to calendarCategoy
     *
     * @return void
     */
    public function calendarCategory()
    {
        return $this->belongsTo('App\Model\CalendarCategory');
    }
}
