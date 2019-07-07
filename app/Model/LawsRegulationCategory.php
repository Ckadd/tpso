<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LawsRegulationCategory extends Model
{
    /**
     * Relation with table lawregulation.
     *
     * @return void
     */
    public function lawregulations()
    {
        return $this->hasMany('App\Model\LawsRegulation', 'law_category_id', 'id');
    }

    /**
     * Relation with table lawRegulationView.
     *
     * @return void
     */
    public function lawregulationsView()
    {
        return $this->hasMany('App\Model\LawRegulationView', 'law_category_id', 'id');
    }
}
