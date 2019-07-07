<?php

namespace App\Repository;

use App\model\Feed;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
class FeedRepository {

    public function getAll(){
        return Feed::all();
    }

    public function getById($id){
        return Feed::where('id',$id)->first();
    }
}
