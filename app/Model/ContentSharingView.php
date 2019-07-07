<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContentSharingView extends Model
{
    /**
     * Relation with table sharingview.
     *
     * @return App\Model\ContentSharingView
     */

    public function contentSharing()
    {
        return $this->belongsTo('App\Model\ContentSharing');
    }
}
