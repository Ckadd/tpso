<?php

namespace App\Service;

use App\Traits\ThemeLanguageTrait;
use App\Traits\ThemeEditorTrait;
use App\Traits\ThemeUploadTrait;
use Theme;

class ThemeService
{
    use ThemeLanguageTrait, ThemeEditorTrait, ThemeUploadTrait;

    protected $themeDirPath;

    protected $allowEditFileTypes = [
        'text/html',
        'text/plain',
        'text/css',
        'text/javascript',
        'text/json',
        'application/css',
        'application/javascript',
        'application/x-javascript',
        'application/json',
    ];

    public function __construct()
    {
        $this->themeDirPath = config('themes.paths.absolute');
    }

    /**
     * Set theme name.
     *
     * @param string $name
     *
     * @return App\Service\ThemeService
     */
    public function setThemeName(string $name)
    {
        $name = rtrim($name, DIRECTORY_SEPARATOR);
        $this->themeDirPath .= (DIRECTORY_SEPARATOR . $name);

        return $this;
    }

    /**
     * Get file list.
     *
     * @return array
     */
    public function getFileList()
    {
        $dir = $this->readDir($this->themeDirPath);

        return $dir;
    }

    /**
     * Read directory.
     *
     * @param string $path
     *
     * @return array
     */
    private function readDir(string $path)
    {
        $dirHandle = scandir($path);

        $result = [];

        foreach ($dirHandle as $directory) {
            if (in_array($directory, ['.', '..'])) {
                continue;
            }

            $fullPath = $path . DIRECTORY_SEPARATOR . $directory;

            if (is_dir($fullPath)) {
                $result[] = [
                    'text'     => $directory,
                    'children' => $this->readDir($fullPath),
                    'data'     => [
                        'path'     => $this->encodePath($fullPath),
                        'type'     => 'dir',
                    ],
                ];
            } else {
                $mime = mime_content_type($fullPath);

                if (!$this->isEditableFile($mime)) {
                    continue;
                }

                $result[] = [
                    'text' => $directory,
                    'data' => [
                        'path' => $this->encodePath($fullPath),
                        'mime' => $mime,
                        'type' => 'file',
                    ],
                ];
            }
        }

        return $result;
    }

    /**
     * Theme translate.
     *
     * @param string $translateKey
     *
     * @return string
     */
    public function themeTranslator(string $translateKey) : string
    {
        return $this->translateFromTheme($this->themeDirPath, $translateKey);
    }

    /**
     * Read file from theme.
     *
     * @param string $filename
     *
     * @return void
     */
    public function readFileFromTheme(string $filename)
    {
        $filename = $this->decodePath($filename);

        return $this->readFile($filename);
    }

    /**
     * Write to theme file.
     *
     * @param string $filename
     * @param string $content
     *
     * @return void
     */
    public function writeToThemeFile(string $filename, string $content)
    {
        $filename = $this->decodePath($filename);

        return $this->writeFile($filename, $content);
    }

    /**
     * Check is file is editable.
     *
     * @param string $mimeType
     *
     * @return bool
     */
    public function isEditableFile(string $mimeType) : bool
    {
        return in_array($mimeType, $this->allowEditFileTypes);
    }

    /**
     * Override theme path
     *
     * @param string $path
     * 
     * @return string
     */
    public static function path(string $path)
    {
        return '/' . Theme::path($path);
    }
}
