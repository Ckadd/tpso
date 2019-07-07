<?php

use Illuminate\Database\Seeder;
use App\Model\News;
use App\Model\NewsOrganization;

class InstallNewsBelongToManyWithOrganizationsTableSeeder extends Seeder
{
    protected $datasForInsert = array();

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get all news 
        $news = $this->getAllNews();

        foreach ($news as $new) {
            $news_id = $new->id;
            $organization_id = $new->organization_id;
            // call for insert to moal
            $this->setupDataForInsertToNewsOrganization($news_id, $organization_id);
        }

        // Let insert to database
        if (!empty($this->datasForInsert)) {
            $this->insertToNewsOrganization($this->datasForInsert);
        }
    }

    /**
     * Get All News Function
     * 
     */
    public function getAllNews() {
        return News::get();
    }

    
    /**
     * Setup Data for Insert for belong to many
     * 
     * @param   int     $news_id
     * @param   int     $organization_id
     * 
     */
    public function setupDataForInsertToNewsOrganization($news_id, $organization_id) {
        $checkNewsOrganizationExists = NewsOrganization::where('news_id', $news_id)->where('organization_id', $organization_id)->get();
        if ($checkNewsOrganizationExists->count() == 0) {
            $temp = array(
                'news_id' => $news_id,
                'organization_id' => $organization_id
            );
            $this->datasForInsert[] = $temp;
        }
    }

    /**
     * Insert for belong to many
     * 
     * @param   array   $datas
     */
    public function insertToNewsOrganization($datas) {
        NewsOrganization::insert($datas);
    }

}
