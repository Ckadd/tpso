<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class AnnualBudgetCategory extends Model
{
    /**
     * relation hasMany to table annualBudget
     *
     * @return void
     */
    public function annualBudget()
    {
        return $this->hasMany('App\Model\AnnualBudget','annual_category_id','id');
    }

    /**
     * relation hasMany to table AnnualBudgetView
     *
     * @return void
     */
    public function annualBudgetView()
    {
        return $this->hasMany('App\Model\AnnualBudgetView','annual_id','id');
    }
}
