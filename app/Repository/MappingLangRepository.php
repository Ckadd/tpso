<?php

namespace App\Repository;

use App\model\MappingLang;
use App\model\News;
use App\model\CalendarDetail;
use App\model\JobPosting;
use App\model\Page;
use App\model\Post;
use App\model\Organization;
use App\model\ServiceList;
use App\model\ContentSharing;
use App\model\Knowledgebase;
use App\model\Banner;
use App\model\Article;
use App\model\Library;
use App\model\AnnualBudget;
use App\model\LawsRegulation;
use App\model\Department;
use App\model\Ebook;
use App\model\StandardTourismPersonnel;
use App\model\MissionStatement;
use App\model\MissionAndAuthority;
use App\model\GalleryItem;
use App\model\Gallery;
use App\model\TravelTip;
use App\model\PublicGuide;
use App\model\TourStandard;
use App\model\LibraryBook;
use App\model\LandmarkStandard;
use App\model\Faq;
use App\model\FormDownload;
use  App\model\ChartStatistic;
use App\Model\DotStatGroup;
use App\Model\DotStatCategory;
use App\Model\DotStatData;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MappingLangRepository {

    protected $mappingLang;

    public function __construct(MappingLang $mappingLang) {
        $this->mappingLang = $mappingLang;
    }

    public function add($data){
        $this->mappingLang->insert($data);
    }

    //News
    public function getSlugLastInsertNew($slug){
        // return News::select('id', 'title')->where('title',$slug)->first();
        return News::select('*')->orderBy('id', 'desc')->first();
    }

    //mapping_lang by master_id
    public function getMappingNew($master_id){
        return $this->mappingLang->where('master_id',$master_id)->get();
    }

    //CalendarDetail
    public function getTitleLastInsertCalendarDetail($title){
        // return CalendarDetail::select('id', 'title')->where('title',$title)->first();
        return CalendarDetail::select('*')->orderBy('id', 'desc')->first();
    }

    //Job Posting
    public function getTitleLastInsertJobPosting($title){
        // return JobPosting::select('id', 'title')->where('title',$title)->first();
        return JobPosting::select('*')->orderBy('id', 'desc')->first();
    }

    //pages
    public function getTitleLastInsertPage($title){
        // return Page::select('id', 'title')->where('title',$title)->first();
        return Page::select('*')->orderBy('id', 'desc')->first();
    }

    //post
    public function getTitleLastInsertPost($title){
        // return Post::select('id', 'title')->where('title',$title)->first();
        return Post::select('*')->orderBy('id', 'desc')->first();
    }

    //organizations
    public function getTitleLastInsertOrganizations($name){
        // return Organization::select('id', 'name')->where('name',$name)->first();
        return Organization::select('*')->orderBy('id', 'desc')->first();
    }

    //service-lists
    public function getTitleLastInsertServiceLists($title){
        // return ServiceList::select('id', 'title')->where('title',$title)->first();
        return ServiceList::select('*')->orderBy('id', 'desc')->first();
    }

    //content-sharings
    public function getTitleLastInsertContentSharing($title){
        // return ContentSharing::select('id', 'title')->where('title',$title)->first();
        return ContentSharing::select('*')->orderBy('id', 'desc')->first();
    }

    //Knowledgebase
    public function getTitleLastInsertKnowledgebases($title){
        // return Knowledgebase::select('id')->where('title',$title)->first();
        return Knowledgebase::select('*')->orderBy('id', 'desc')->first();
    }

    //Banner
    public function getTitleLastInsertBanner(){
        return Banner::select('*')->orderBy('id', 'desc')->first();
    }

    //articles
    public function getTitleLastInsertArticle($title){
        // return Article::select('id', 'title')->where('title',$title)->first();
        return Article::select('*')->orderBy('id', 'desc')->first();
    }

    //Library
    public function getTitleLastInsertLibrarie($title){
        // return Library::select('id', 'title')->where('title',$title)->first();
        return Library::select('*')->orderBy('id', 'desc')->first();
    }

    //AnnualBudget
    public function getTitleLastInsertAnnualBudget($title){
        // return AnnualBudget::select('id', 'title')->where('title',$title)->first();
        return AnnualBudget::select('*')->orderBy('id', 'desc')->first();
    }

    //LawsRegulation
    public function getTitleLastInsertLawsRegulation($title){
        // return LawsRegulation::select('id', 'title')->where('title',$title)->first();
        return LawsRegulation::select('*')->orderBy('id', 'desc')->first();
    }

    //Department
    public function getTitleLastInsertDepartment($title){
        // return Department::select('id', 'title')->where('title',$title)->first();
        return Department::select('*')->orderBy('id', 'desc')->first();
    }

    //Department
    public function getNameLastInsertEbook($name){
        // return Ebook::select('id', 'name')->where('name',$name)->first();
        return Ebook::select('*')->orderBy('id', 'desc')->first();
    }

    //StandardTourismPersonnel
    public function getTitleLastInsertStandardTourismPersonnels($title){
        // return StandardTourismPersonnel::select('id', 'title')->where('title',$title)->first();
        return StandardTourismPersonnel::select('*')->orderBy('id', 'desc')->first();
    }

    //MissionStatement
    public function getTitleLastInsertMissionStatement($title){
        // return MissionStatement::select('id', 'title')->where('title',$title)->first();
        return MissionStatement::select('*')->orderBy('id', 'desc')->first();
    }

    //MissionAndAuthority
    public function getTitleLastInsertMissionAndAuthoritie($title){
        // return MissionAndAuthority::select('id', 'title')->where('title',$title)->first();
        return MissionAndAuthority::select('*')->orderBy('id', 'desc')->first();
    }

    //GalleryItem
    public function getTitleLastInsertGalleryItem(){
        // return GalleryItem::select('*')->orderBy('id', 'desc')->first();
        return GalleryItem::select('*')->orderBy('id', 'desc')->first();
    }

    //Gallery
    public function getNameLastInsertGalleries($name){
        // return Gallery::select('id', 'name')->where('name',$name)->first();
        return Gallery::select('*')->orderBy('id', 'desc')->first();
    }

    //TravelTip
    public function getTitleLastInsertTravelTips($title){
        // return TravelTip::select('id', 'title')->where('title',$title)->first();
        return TravelTip::select('*')->orderBy('id', 'desc')->first();
    }

    //PublicGuide
    public function getTitleLastInsertPpublicGuide($title){
        // return PublicGuide::select('id', 'title')->where('title',$title)->first();
        return PublicGuide::select('*')->orderBy('id', 'desc')->first();
    }

    //TourStandard
    public function getTitleLastInsertTourStandards($title){
        // return TourStandard::select('id', 'title')->where('title',$title)->first();
        return TourStandard::select('*')->orderBy('id', 'desc')->first();
    }

    //LibraryBook
    public function getTitleLastInsertLibraryBook($title){
        // return LibraryBook::select('id', 'title')->where('title',$title)->first();
        return LibraryBook::select('*')->orderBy('id', 'desc')->first();
    }

    //LandmarkStandard
    public function getTitleLastInsertLandmarkStandard($title){
        // return LandmarkStandard::select('id', 'title')->where('title',$title)->first();
        return LandmarkStandard::select('*')->orderBy('id', 'desc')->first();
    }
    //Faq
    public function getTitleLastInsertFaq($title){
        // return Faq::select('id', 'title')->where('title',$title)->first();
        return Faq::select('*')->orderBy('id', 'desc')->first();
    }

    //FormDownload
    public function getTitleLastInsertFormDownload($title){
        // return FormDownload::select('id', 'title')->where('title',$title)->first();
        return FormDownload::select('*')->orderBy('id', 'desc')->first();
    }

    //ChartStatistic
    public function getTitleLastInsertChartStatistics(){
        return ChartStatistic::select('*')->orderBy('id', 'desc')->first();
    }

    //dot-stat-group
    public function getTitleLastInsertDotStatGroup(){
        return DotStatGroup::select('*')->orderBy('id', 'desc')->first();
    }

    //dot-stat-category
    public function getTitleLastInsertDotStatCategory(){
        return DotStatCategory::select('*')->orderBy('id', 'desc')->first();
    }

    //dot-stat-data
    public function getTitleLastInsertDotStatData(){
        return DotStatData::select('*')->orderBy('id', 'desc')->first();
    }

    /**
     * Get all ids for delete
     * 
     * @param   string      $slug
     * @param   array       $ids
     * @return  array       $ids
     */
    public static function getAllRelateIdsForDelete($slug, $allIds) {
        $ids = array(
            'content_ids' => array(),
            'mapping_ids' => array()
        );

        $results = \App\Model\MappingLang::where('module', $slug)->where(function($q) use ($allIds) {
                foreach($allIds as $id) {
                    $q->where('master_id', $id)
                        ->orWhere('parent_id', $id);
                }
            })->get();

        foreach ($results as $result) {
            if (!in_array($result->id, $ids['mapping_ids'])) {
                array_push($ids['mapping_ids'], $result->id);
            }
            if (!in_array($result->master_id, $ids['content_ids'])) {
                array_push($ids['content_ids'], $result->master_id);
            }
            if (!in_array($result->parent_id, $ids['content_ids'])) {
                array_push($ids['content_ids'], $result->parent_id);
            }
        }

        $ids['content_ids'] = array_merge($ids['content_ids'], $allIds);

        return $ids;
    }

    /**
     * Delete mapping by ids
     * 
     * @param   array       $ids
     * @return  boolean
     */
    public static function deleteByIds($ids) {
        if (is_array($ids)) {
            return \App\Model\MappingLang::whereIn('id', $ids)->delete();
        } else {
            return \App\Model\MappingLang::where('id', $ids)->delete();
        }
        return false;
    }

    /**
     * Duplicate fields from master_id to child_id
     * some fields ex. image field, file field
     * 
     * @param   object      $request
     * @param   int         $child_id
     * @param   object      $dataType
     * 
     * @return  void
     */
    public function deplicateNotExistsField($request, $child_id, $dataType) {
        $model = new $dataType->model_name();
        $master_content = false;

        if ($request->master_id) {
            $master_content = $model->where('id', $request->master_id)->first()->toArray();
            $child_content = $model->where('id', $child_id)->first()->toArray();
            
            unset($master_content['id']);

            foreach($master_content as $key => $column) {
                if ($column != null && ($child_content[$key] == null || empty($child_content[$key]))) {
                    $child_content[$key] = $column;
                }
            }

            $model->where('id', $child_id)->update($child_content);
        }
    }
}
