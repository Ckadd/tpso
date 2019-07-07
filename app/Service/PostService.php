<?php

namespace App\Service;

class PostService {
    
    public static function listContentFooter() {
        $postFooterRepository = app()->make('App\Repository\PostRepository');
        return $postFooterRepository->listPostFooter();
        
    }
}
