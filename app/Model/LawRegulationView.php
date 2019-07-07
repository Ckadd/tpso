<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LawRegulationView extends Model
{
    /**
     * relation belong to lawsregulationCategory
     *
     * @return void
     */
    public function lawsRegulationCategory()
    {
        return $this->belongsTo('App\Model\LawsRegulationCategory', 'law_category_id', 'id');
    }
}
