<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class FormGenerate extends Model
{
    /**
     * Relation with table formgenerate-detail.
     *
     * @return void
     */
    public function formDetail()
    {
        return $this->hasMany('App\Model\FormGenerateDetail', 'form_id', 'id');
    }
}
