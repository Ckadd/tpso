<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PollAnswersUser extends Model
{
    public function getAnswer()
    {
        return $this->belongsTo('App\Model\PollAnswer', 'answer_id', 'id');
    }
}
