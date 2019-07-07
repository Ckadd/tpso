<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Poll extends Model
{
    public function answers()
    {
        return $this->hasMany('App\Model\PollQuestion','poll_id','id');
    }
}
