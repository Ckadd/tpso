<?php

namespace App\Service;

class NewletterCategoryService
{
    /**
     * list data all relation from NewletterCategoryService.
     *
     * @param mixed $id
     *
     * @return array
     */

    public static function findDetailInNewletterDetail($id)
    {
        $newletterCategoryRepository = app()->make('App\Repository\NewletterSubScribeRepository');

        return $newletterCategoryRepository->findDetailInNewletterDetail($id);
    }
}
