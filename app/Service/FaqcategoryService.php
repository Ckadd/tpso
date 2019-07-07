<?php

namespace App\Service;

class FaqcategoryService
{
    /**
     * list data all relation from faqs.
     *
     * @param mixed $id
     *
     * @return array
     */
    public static function findFaqInFaqcategory($id)
    {
        $faqCategoryRepository = app()->make('App\Repository\FaqCategoryRepository');

        return $faqCategoryRepository->findFaqInFaqcategory($id);
    }
}
