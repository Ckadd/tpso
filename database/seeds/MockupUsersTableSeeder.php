<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class MockupUsersTableSeeder extends Seeder
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
            $check = User::where('name','Jo')->get()->toArray();
            
            if(empty($check)) {
                User::create([
                    'name'           => 'Jo',
                    'email'          => 'jo@admin.com',
                    'password'       => bcrypt('jo@admin.com'),
                    'remember_token' => str_random(60),
                    'role_id'        => $role->id,
                ]);
            }
        }
    }
}
