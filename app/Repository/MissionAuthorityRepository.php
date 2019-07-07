<?php 

namespace App\Repository;
use App\Model\MissionAndAuthority;

class MissionAuthorityRepository { 

    protected $missionAuthorityRepository;

    public function __construct(MissionAndAuthority $missionAuthorityRepository) {
        $this->missionAuthorityRepository = $missionAuthorityRepository;
    }

    public function listData() {

        return $this->missionAuthorityRepository::where('status',1)->orderBy('id','DESC')->get()->toArray();
    }

    public function listfileById(int $id) { 
        $data = $this->missionAuthorityRepository::find($id)->toArray();
        $explodecomma = explode(',',$data['image']);
        $replacepath = str_replace('\\','/',$explodecomma);
        return $replacepath;
    }
}