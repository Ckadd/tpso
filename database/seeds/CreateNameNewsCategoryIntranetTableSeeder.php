<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreateNameNewsCategoryIntranetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTitleNewsCategory();
    }

    public function createTitleNewsCategory()
    {
        $checkTitleAnnounce = DB::table('news_categories')->where('name','ประกาศกรมการท่องเที่ยว')->count();
        if(empty($checkTitleAnnounce)) {
            $this->createTitleName('ประกาศกรมการท่องเที่ยว');
        }

        $checkTitleAnnounceRegistrar = DB::table('news_categories')->where('name','ประกาศกรมนายทะเบียน')->count();
        if(empty($checkTitleAnnounceRegistrar)) {
            $this->createTitleName('ประกาศกรมนายทะเบียน');
        }

        $checkTitleAnnounceInfomation = DB::table('news_categories')->where('name','ประกาศจากกลุ่มเทคโนโลยีสารสนเทศ')->count();
        if(empty($checkTitleAnnounceInfomation)) {
            $this->createTitleName('ประกาศจากกลุ่มเทคโนโลยีสารสนเทศ');
        }

        $checkTitleAnnounceStaff = DB::table('news_categories')->where('name','ประกาศจากกองการเจ้าหน้าที่')->count();
        if(empty($checkTitleAnnounceStaff)) {
            $this->createTitleName('ประกาศจากกองการเจ้าหน้าที่');
        }

        $checkTitleBookDot = DB::table('news_categories')->where('name','หนังสือเวียนจากกรมการท่องเที่ยว')->count();
        if(empty($checkTitleBookDot)) {
            $this->createTitleName('หนังสือเวียนจากกรมการท่องเที่ยว');
        }

        $checkTitleActivity = DB::table('news_categories')->where('name','ข่าวกิจกรรม')->count();
        if(empty($checkTitleActivity)) {
            $this->createTitleName('ข่าวกิจกรรม');
        }

        $checkTitleActivity = DB::table('news_categories')->where('name','ข่าวสารธุรกิจนำเที่ยวและมัคคุเทศก์')->count();
        if(empty($checkTitleActivity)) {
            $this->createTitleName('ข่าวสารธุรกิจนำเที่ยวและมัคคุเทศก์');
        }
    }

    public function createTitleName(string $name)
    {
        DB::table('news_categories')->insert([
            'name' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
