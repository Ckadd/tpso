<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class MockupUserTestOrganization extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() > 0) {
            $role = Role::where('name', 'admin')->firstOrFail();
                $userTourism = [
                    'anchaleephon_k@tourism.go.th',
                    'janjira_p@tourism.go.th',
                    'weena_l@tourism.go.th',
                    'chompunut_p@tourism.go.th',
                    'kanokkarn_n@tourism.go.th',
                    'nannapat_k@tourism.go.th',
                    'darawadee_e@tourism.go.th',
                    'praewwanit_w@tourism.go.th',
                    'nipnon_c@tourism.go.th',
                    'ekaphol_c@tourism.go.th',
                    'passaporn_p@tourism.go.th',
                    'nadradee_j@tourism.go.th',
                    'wiewrunaat_b@tourism.go.th',
                    'kanokwan_j@tourism.go.th',
                    'somporn_c@tourism.go.th',
                    'amonphong_y@tourism.go.th',
                    'susupadech_p@tourism.go.th',
                    'natthaporn_j@tourism.go.th',
                    'prawit_b@tourism.go.th',
                    'ratchapol_n@tourism.go.th',
                    'kanjanporn_k@tourism.go.th',
                    'aoythip_b@tourism.go.th',
                    'pat_v@tourism.go.th',
                    'kontipuck_k@tourism.go.th',
                    'manasanant_h@tourism.go.th',
                    'warunee_k@tourism.go.th',
                ];

                $names = [
                    'Anchaleephon',
                    'Janjira',
                    'Weena',
                    'Chompunut',
                    'Kanokkarn',
                    'Nannapat',
                    'Darawadee',
                    'Praewwanit',
                    'Nipnon',
                    'Ekaphol',
                    'Passaporn',
                    'Nadradee',
                    'Wiewrunaat',
                    'Kanokwan',
                    'Somporn',
                    'Amonphong',
                    'Susupadech',
                    'Natthaporn',
                    'Prawit',
                    'Ratchapol',
                    'Kanjanporn',
                    'Aoythip',
                    'Pat',
                    'Kontipuck',
                    'Manasanant',
                    'Warunee',
                ];

                foreach($userTourism as $key => $value) { 
                    User::create([
                        'name'           => $names[$key],
                        'email'          => $value,
                        'password'       => bcrypt('N2OyLdCP'),
                        'remember_token' => str_random(60),
                        'role_id'        => $role->id,
                    ]);
                }
                $user = new User();

                
                // User::update([
                //     'password' => bcrypt('N2OyLdCP')
                // ])->where('id','>',2)->get();
            
        }
    }
}
