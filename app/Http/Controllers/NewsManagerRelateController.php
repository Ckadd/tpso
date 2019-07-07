<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsManageRelateRepository;

class NewsManagerRelateController extends Controller
{
    protected $newRepository;
    protected $newManagerelateRepository;

    public function __construct(

        NewsCategoryRepository $newRepository,
        NewsManageRelateRepository $newManagerelateRepository
    )
    {
        $this->newRepository = $newRepository;
        $this->newManagerelateRepository = $newManagerelateRepository;
    }

    public function manageRelate(int $id)
    {
        $data = $this->newRepository->findNewById($id);

        if(!empty($data)) {
            $categoryId = $data[0]['category_id'];
            $newId = $data[0]['id'];
            $organizationId = $this->newRepository->organizationBynewId($newId);
            $query['data'] = $this->newRepository->listNewRelate($organizationId,$categoryId,$newId);            
            $query['idNew'] = $newId;
            
            return view('vendor.voyager.news.manager-relate',$query);
        }
        
        return view('vendor.voyager.news.manager-relate');
    }

    public function update(Request $request)
    {
        $request = $request->all();
        $news = $request['news'];
        $newId = $request['idNew'];
        
        if(!empty($news) && !empty($newId)) {
            $this->newManagerelateRepository->updateNewsRelate($news,$newId);
            
            return redirect('/admin/news')->with('msg-related','บันทึกข้อมูลเสร็จสิ้น');
        }
    }
}