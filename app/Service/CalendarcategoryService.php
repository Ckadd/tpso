<?php

namespace App\Service;

class CalendarcategoryService
{
    /**
     * list data all relation from calendarDetail.
     *
     * @param mixed $id
     *
     * @return array
     */
    public static function findCalendarDetail($id)
    {
        $calendarCategoryRepository = app()->make('App\Repository\CalendarCategoryRepository');

        return $calendarCategoryRepository->findcalendarDetailCategory($id);
    }
}
