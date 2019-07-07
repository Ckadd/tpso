<?php

namespace App\Traits;

trait ThemeLanguageTrait
{
    /**
     * Get current theme.
     *
     * @return string
     */
    public function getCurrentTheme() : string
    {
        $fileConfigService = app()->make('App\Service\FileConfigService');
        $currentTheme      = $fileConfigService->get('theme.active');

        if (empty($currentTheme)) {
            $currentTheme = config('themes.active');
        }

        return $currentTheme;
    }

    /**
     * Get language from theme.
     *
     * @param string $themeDirPath
     *
     * @return array
     */
    public function getLanguageFromTheme(string $themeDirPath) : array
    {
        $path = [
            $themeDirPath,
            $this->getCurrentTheme(),
            'lang',
            app()->getLocale() . '.json',
        ];

        $translator       = [];
        $currentThemePath = implode(DIRECTORY_SEPARATOR, $path);

        if (file_exists($currentThemePath)) {
            $translator = json_decode(file_get_contents($currentThemePath), true);
        }

        return $translator;
    }

    /**
     * Translate from theme.
     *
     * @param string $themeDirPath
     * @param string $translateKey
     *
     * @return string|null
     */
    public function translateFromTheme(string $themeDirPath, string $translateKey) : ?string
    {
        $translator = $this->getLanguageFromTheme($themeDirPath);

        return empty($translator) ? '' : array_get($translator, $translateKey);
    }
}
