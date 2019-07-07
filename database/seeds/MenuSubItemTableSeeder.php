<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuSubItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // query id MainMenu
        $mainMenu = Menu::select('id')
        ->where('name','top-menu')->get()->toArray(); 
        $idMain = $mainMenu[0]['id'];

        $mainMenu_internal = Menu::select('id')
        ->where('name','sub-internalMenu')->get()->toArray(); 
        $idMain_internal = $mainMenu_internal[0]['id'];
        
        // check MenuItem
        $checkMenuItem = MenuItem::where('menu_id',$idMain)->get()->toArray();
        if(empty($checkMenuItem)) {
            $menus = [
                [
                    'title' => 'หน้าแรก',
                    'url' => '/index',
                    'order' => 1
                ],
                [
                    'title' => 'เกี่ยวกับกรม',
                    'url' => '/abot-dot',
                    'order' => 2
                ],
                [
                    'title' => 'หน่วยงานภายใน',
                    'url' => '/internal-department',
                    'order' => 3
                ],
                [
                    'title' => 'ข่าวสาร',
                    'url' => '/news',
                    'order' => 15
                ],
                [
                    'title' => 'ข้อมูลบริการ',
                    'url' => '/services',
                    'order' => 16
                ],
                [
                    'title' => 'คลังความรู้',
                    'url' => '/library',
                    'order' => 17
                ],
                [
                    'title' => 'ติดต่อกรม',
                    'url' => '/contact-us',
                    'order' => 18
                ],
                [
                    'title' => 'INTRANET',
                    'url' => '/intranet',
                    'order' => 19
                ],
            ];
            foreach($menus as $menu) {
                $menu['color']='#000000';
                MenuItem::insert([
                    'menu_id' => $idMain,
                    'title' => $menu['title'],
                    'url' => $menu['url'],
                    'color' => $menu['color'],
                    'order' => $menu['order']
                ]);
            }

            

            //query data idMenuInternal
            $dataInternal = MenuItem::where([
                'menu_id' => $idMain,
                'url' => '/internal-department'
            ])->get()->toArray();
            $idInternal = $dataInternal[0]['id'];
    
            // sub menu Internal
            $menuSubs = [
                [
                    'title' => 'Office of the Secretary',
                    'url' => '/office-of-the-secretary',
                ],
                [
                    'title' => 'Thailand Film Office',
                    'url' => '/thailand-film-office',
                ],
                [
                    'title' => 'Bureau of Tourism Business and Guide',
                    'url' => '/bureau-of-tourism-business-and-guide',
                ],
                [
                    'title' => 'Innovation Network',
                    'url' => '/innovation-network',
                ],
                [
                    'title' => 'Business and Tourism ServiceDevelopment',
                    'url' => '/business-and-tourism-servicedevelopment',
                ],
                [
                    'title' => 'Ethics Protection Section',
                    'url' => '/ethics-protection-section',
                ],
                [
                    'title' => 'Human Resources Development Division',
                    'url' => '/human-resources-development-division',
                ],
                [
                    'title' => 'Bureau of Tourism attraction Development',
                    'url' => '/bureau-of-tourism-attraction-development',
                ],
                [
                    'title' => 'Internal Audit Section',
                    'url' => '/internal-audit-section',
                ],
                [
                    'title' => 'Public sector development division',
                    'url' => '/public-sector-development-division',
                ],
            ];

            foreach($menuSubs as $keysub => $valsub) {
                $valsub['color']='#000000';
                MenuItem::insert([
                    'menu_id' => $idMain,
                    'title' => $valsub['title'],
                    'url' => $valsub['url'],
                    'color' => $valsub['color'],
                    'parent_id' => $idInternal,
                    'order' => $keysub+1
                ]);
            }
        }
        // query submenu internal 
        $checkMenuItem_internal = MenuItem::where('menu_id',$idMain_internal)->get()->toArray();
        if(empty($checkMenuItem_internal)) {
            
            $menuSubs_internal = [
                [
                    'title' => 'Office of the Secretary',
                    'url' => '/office-of-the-secretary',
                ],
                [
                    'title' => 'Thailand Film Office',
                    'url' => '/thailand-film-office',
                ],
                [
                    'title' => 'Bureau of Tourism Business and Guide',
                    'url' => '/bureau-of-tourism-business-and-guide',
                ],
                [
                    'title' => 'Innovation Network',
                    'url' => '/innovation-network',
                ],
                [
                    'title' => 'Business and Tourism ServiceDevelopment',
                    'url' => '/business-and-tourism-servicedevelopment',
                ],
                [
                    'title' => 'Ethics Protection Section',
                    'url' => '/ethics-protection-section',
                ],
                [
                    'title' => 'Human Resources Development Division',
                    'url' => '/human-resources-development-division',
                ],
                [
                    'title' => 'Bureau of Tourism attraction Development',
                    'url' => '/bureau-of-tourism-attraction-development',
                ],
                [
                    'title' => 'Internal Audit Section',
                    'url' => '/internal-audit-section',
                ],
                [
                    'title' => 'Public sector development division',
                    'url' => '/public-sector-development-division',
                ],
            ];
            foreach($menuSubs_internal as $key_internal => $menu_internal) {
                $menu_internal['color']='#000000';
                MenuItem::insert([
                    'menu_id' => $idMain_internal,
                    'title' => $menu_internal['title'],
                    'url' => $menu_internal['url'],
                    'color' => $menu_internal['color'],
                    'order' => $key_internal + 1
                ]);
            }
        }
    }
}