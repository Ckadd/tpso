<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\HasRelationships;

class Theme extends Model
{
    // use HasRelationships;

    protected $fillable = [
        'name',
        'slug',
        'zip_path',
        'is_active',
        'user_id',
    ];
}
