<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerSettingsController;

class CustomVoyagerSettingsController extends VoyagerSettingsController
{

    public function update(Request $request)
    {
        // check banner side default 1000
        $requestData = $request->all();
        
        if(!empty($requestData['site_banner_slide'])) {
            
            ($requestData['site_banner_slide'] < 1000) ? $request->merge(['site_banner_slide' => 1000]) : '';
        }
        
        // Check permission
        $this->authorize('edit', Voyager::model('Setting'));

        $settings = Voyager::model('Setting')->all();

        foreach ($settings as $setting) {
            $content = $this->getContentBasedOnType($request, 'settings', (object) [
                'type'    => $setting->type,
                'field'   => str_replace('.', '_', $setting->key),
                'details' => $setting->details,
                'group'   => $setting->group,
            ]);

            if ($setting->type == 'image' && $content == null) {
                continue;
            }

            if ($setting->type == 'file' && $content == json_encode([])) {
                continue;
            }

            $key = preg_replace('/^'.str_slug($setting->group).'./i', '', $setting->key);

            $setting->group = $request->input(str_replace('.', '_', $setting->key).'_group');
            $setting->key = implode('.', [str_slug($setting->group), $key]);
            $setting->value = $content;
            $setting->save();
        }

        request()->flashOnly('setting_tab');

        return back()->with([
            'message'    => __('voyager::settings.successfully_saved'),
            'alert-type' => 'success',
        ]);
    }
}
