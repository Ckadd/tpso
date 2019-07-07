<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class AnnualBudget extends Model
{
    /**
     * relation belong to annualBudgetCategory
     *
     * @return void
     */
    public function annualBudgetCategory()
    {
        return $this->belongsTo('App\Model\AnnualBudgetCategory','annual_category_id','id');
    }
}
