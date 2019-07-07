<?php

use Illuminate\Database\Seeder;

class InstallLangAdminMenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Languages
        if ($this->isTableExistsLangCate()) {
            // $this->info('Table news is already exists');
            return;
        }else{
            $this->insertToMenuItems(1);
        }
        //Language Types
        if ($this->isTableExistsLang()) {
            // $this->info('Table news is already exists');
            return;
        }else{
            $this->insertToMenuItems(2);
        }
        //Language Key
        if ($this->isTableExistsLangKey()) {
            // $this->info('Table news is already exists');
            return;
        }else{
            $this->insertToMenuItems(3);
        }

    }

    public function isTableExistsLangCate()
    {
        return DB::table('menu_items')->where('title', 'Languages')
            ->count();
    }

    public function isTableExistsLang()
    {
        return DB::table('menu_items')->where('title', 'Language Types')
            ->count();
    }

    public function isTableExistsLangKey()
    {
        return DB::table('menu_items')->where('title', 'Language Key')
            ->count();
    }

    public function insertToMenuItems($type)
    {
        if($type == 1){
            $mt = DB::table('menu_items')->orderBy('order', 'desc')->first();
            $order = $mt->order + 1;
            return DB::table('menu_items')->insertGetId([
                'menu_id' => 1,
                'title' => 'Languages',
                'url' => ' ',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => '#000000',
                'parent_id' => null,
                'order' => $order
            ]);
        }else if($type == 2){
            $mt = DB::table('menu_items')->where('title', 'Languages')
                ->first();
            if($mt) {
                return DB::table('menu_items')->insertGetId([
                    'menu_id' => 1,
                    'title' => 'Language Types',
                    'url' => 'admin/language-types',
                    'target' => '_self',
                    'icon_class' => 'voyager-dot',
                    'color' => '#000000',
                    'parent_id' => $mt->id,
                    'order' => 1
                ]);
            }
        }else if($type == 3){
            $mt = DB::table('menu_items')->where('title', 'Languages')
                ->first();
            if($mt) {
                return DB::table('menu_items')->insertGetId([
                    'menu_id' => 1,
                    'title' => 'Language Key',
                    'url' => 'admin/languages',
                    'target' => '_self',
                    'icon_class' => 'voyager-dot',
                    'color' => '#000000',
                    'parent_id' => $mt->id,
                    'order' => 2
                ]);
            }

        }
    }
}
