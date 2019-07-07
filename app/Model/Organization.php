<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * Relation with table user.
     *
     * @return App\Model\User
     */
    public function users()
    {
        return $this->hasMany('App\Model\User', 'organization_id', 'id');
    }
}
