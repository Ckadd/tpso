<?php

namespace App\Repository;

use App\Model\ContactView;

class ContactUsRepository {

    protected $contactUsModel;

    public function __construct(ContactView $contactUsModel)
    {
        $this->contactUsModel = $contactUsModel;
    }

    public function addLogContactUs(Array $data) {
        
        $this->contactUsModel::insert([
            'fullname' => $data[0],
            'id_card'  => $data[1],
            'phone'    => $data[2],
            'email'    => $data[3],
            'title'    => $data[4],
            'description' => $data[5],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
    }
}