<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PollQuestion extends Model
{
    public function answers()
    {
        return $this->hasMany('App\Model\PollAnswer','question_id','id');
    }
}
