<?php

namespace App\Service;

class FormgenerateService
{
    /**
     * list data all relation from formgenerate.
     *
     * @param mixed $id
     *
     * @return array
     */
    public static function findDetailInFormgenerate($id)
    {
        $formgenerateRepository = app()->make('App\Repository\FormGenerateRepository');

        return $formgenerateRepository->findDetailInFormgenerate($id);
    }

    public static function sumDataDetailInFormgenerate($id)
    {
        $formgenerateRepository = app()->make('App\Repository\FormGenerateRepository');

        return $formgenerateRepository->sumDataDetailInFormgenerate($id);
    }
}
