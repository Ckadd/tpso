<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PollAnswer extends Model
{
    public function userAnswer()
    {
        return $this->hasMany('App\Model\PollAnswersUser','answer_id','id');
    }
}
