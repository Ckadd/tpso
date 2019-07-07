<?php

use Illuminate\Database\Seeder;
use App\Service\FileConfigService;
use App\Traits\SeederTrait;

class InstallDefaultTheme extends Seeder
{
    use SeederTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isDefaultThemeIsSet()) {
            $this->info('Theme is set already');
            return;
        }

        $fileConfig = new FileConfigService;
        $activeTheme = $fileConfig->set('theme.active', 'dot');
        $this->success('Set default theme is done');
        $this->insertDefaultTheme();
        $this->success('Insert new theme to database done');
    }

    public function isDefaultThemeIsSet()
    {
        $fileConfig = new FileConfigService;
        $activeTheme = $fileConfig->get('theme.active');

        return !empty($activeTheme);
    }

    public function insertDefaultTheme()
    {
        $isDefaultThemeExists = DB::table('themes')->where('slug', 'dot')->count();

        if ($isDefaultThemeExists) {
            return;
        }

        DB::table('themes')->insert([
            'name' => 'dot',
            'is_active' => 1,
            'user_id' => 1,
            'zip_path' => '',
            'slug' => 'dot',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
