<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class AnnualBudgetView extends Model
{
    /**
     * relation belong to annualBudgetCategory
     *
     * @return void
     */
    public function annualBudgetCategory()
    {
        return $this->belongsTo('App\Model\AnnualBudgetCategory');
    }
}
