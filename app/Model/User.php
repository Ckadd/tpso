<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'organization_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relation with table organization.
     *
     * @return App\Model\User
     */
    public function organization()
    {
        return $this->belongsTo('App\Model\Organization', 'organization_id', 'id');
    }
}
