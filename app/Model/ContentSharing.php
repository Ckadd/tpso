<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContentSharing extends Model
{
    // protected $table = "content_sharing";

    public function sharingview()
    {
        return $this->hasMany('App\Model\ContentSharingView','content_id','id');
    }
}
