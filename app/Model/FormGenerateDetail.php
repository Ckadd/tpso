<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class FormGenerateDetail extends Model
{
    public $timestamps = true;

    /**
     * Relation with table sharingview.
     *
     * @return App\Model\FormGenerate
     */

    public function formGenerate()
    {
        return $this->belongsTo('App\Model\FormGenerate');
    }
}
