<?php

namespace App\Repository;

use App\model\CalendarCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CalendarCategoryRepository { 

    protected $calendarCategoryRepository;

    public function __construct(CalendarCategory $calendarCategoryRepository) { 
        $this->calendarCategoryRepository = $calendarCategoryRepository;
    }

    public function findcalendarDetailCategory(int $id) { 
        return $this->calendarCategoryRepository->with('calendarDetail')->where('id',$id)->get()->toArray();
    }

    public function listCategory() {
        return $this->calendarCategoryRepository->all()->toArray();
    }

    public function listMonth() {  
       $data = DB::table('calendar_details')
       ->select(DB::raw(' DISTINCT(MONTHNAME(datetime)) AS Month'))
       ->where('status',1)
       ->get()
       ->toArray();

       return $data;
    }

    public function listCategoryById(string $name) {
        
        $query = $this->calendarCategoryRepository::where('title',$name)->get()->toArray();
        return $query[0]['id'];
    }
}