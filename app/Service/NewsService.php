<?php

namespace App\Service;

class NewsService
{
    /**
     * Get category by user.
     *
     * @param mixed $userId
     *
     * @return array
     */
    public static function getCategoryByUser($userId)
    {
        $newsCategoryRepository = app()->make('App\Repository\NewsCategoryRepository');

        return $newsCategoryRepository->getCategoryByUser($userId);
    }

    public static function getIdNewManager()
    {
        $newsCategoryRepository  = app()->make('App\Repository\NewsCategoryRepository');

        return $newsCategoryRepository->newManagerId();
    }

    public static function getCategory()
    {
        $newsCategoryRepository  = app()->make('App\Repository\NewsCategoryRepository');
        return $newsCategoryRepository->listCategory();
    }
}
