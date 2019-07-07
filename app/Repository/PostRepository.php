<?php

namespace App\Repository;

use App\Model\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App;
use App\Model\MappingLang;

class PostRepository
{
    protected $postRepository;

    public function __construct(Post $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listPostFooter()
    {
        return $this->getData('footer-post');
    }

    public function listPostPermissionIndex()
    {
        $data = $this->postRepository->leftJoin('mapping_langs', 'posts.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'posts')
            ->where('posts.slug', 'permission-of-tourism-business')
            ->where('posts.status', 'PUBLISHED')
            ->select('posts.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
            ->get()->toArray();
        if (count($data) <= 0) {
            $data = $this->postRepository->leftJoin('mapping_langs', 'posts.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'posts')
                ->where('posts.slug', 'permission-of-tourism-business')
                ->where('posts.status', 'PUBLISHED')
                ->select('posts.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->get()->toArray();
        }
        return $data;
    }

    public function listPostVerifyLicenseIndex()
    {
        $data = $this->postRepository->leftJoin('mapping_langs', 'posts.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'posts')
            ->where('posts.slug', 'verify-a-license')
            ->where('posts.status', 'PUBLISHED')
            ->select('posts.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
            ->get()->toArray();
        if (count($data) <= 0) {
            $data = $this->postRepository->leftJoin('mapping_langs', 'posts.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'posts')
                ->where('posts.slug', 'verify-a-license')
                ->where('posts.status', 'PUBLISHED')
                ->select('posts.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->get()->toArray();
        }
        return $data;
    }

    public function contactAddress()
    {
        return $this->getData('contact-us-address');
    }

    public function contactTravel()
    {
        return $this->getData('contact-us-travel');
    }

    /**
     * get Data By Slug
     *
     * @param string $slug
     * @return void
     */
    function getData(string $slug) {
        $data = $this->postRepository->leftJoin('mapping_langs', 'posts.id', '=', 'mapping_langs.master_id')
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'posts')
            ->where('posts.slug', $slug)
            ->where('posts.status', 'PUBLISHED')
            ->select('posts.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
            ->get()->toArray();
            
        if (count($data) <= 0) {
            $data = $this->postRepository->leftJoin('mapping_langs', 'posts.id', '=', 'mapping_langs.master_id')
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'posts')
                ->where('posts.slug', $slug)
                ->where('posts.status', 'PUBLISHED')
                ->select('posts.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->get()->toArray();
        }
        return $data;
    }

}
