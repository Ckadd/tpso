<?php

namespace App\Traits;

use App\Exceptions\ThemeInvalidZipFileException;
use App\Exceptions\ThemeAlreadyExistsException;
use App\Exceptions\ThemeJsonNotFoundException;
use App\Exceptions\ThemeNotPermissionCreateTempDirectory;

trait ThemeUploadTrait
{
    /**
     * Get base path for upload theme file.
     *
     * @return string
     */
    public function getUploadBasePath()
    {
        return storage_path('app') . DIRECTORY_SEPARATOR;
    }

    /**
     * Upload theme file.
     *
     * @param string $zipFile
     *
     * @return array
     */
    public function uploadTheme($zipFile)
    {
        $zipFilePath = null;

        foreach ($zipFile->file('zip_path') as $file) {
            $zipFilePath = $this->getUploadBasePath() . $file->store('themes');
        }

        if (empty($zipFilePath)) {
            throw new ThemeInvalidZipFileException;
        }

        $extractDirPath = $this->unZipFile($zipFilePath);

        if (empty($extractDirPath)) {
            throw new ThemeNotPermissionCreateTempDirectory;
        }

        $themeContent = $this->validateTheme($extractDirPath);

        if (empty($themeContent)) {
            throw new ThemeJsonNotFoundException;
        }

        $this->moveToThemeDir($themeContent, $extractDirPath, $this->themeDirPath);

        return $themeContent;
    }

    /**
     * Unzip theme file.
     *
     * @param string $zipFilePath
     *
     * @return string
     */
    public function unZipFile($zipFilePath)
    {
        $zip = new \ZipArchive;

        $isZipOpened    = $zip->open($zipFilePath);
        $extractDirPath = false;

        if (true === $isZipOpened) {
            $newDirName     = pathinfo($zipFilePath)['filename'];
            $extractDirPath = $this->getUploadBasePath() . 'themes' . DIRECTORY_SEPARATOR . $newDirName;
            $zip->extractTo($extractDirPath);
            $zip->close();
        }

        return $extractDirPath;
    }

    /**
     * Validate theme.
     *
     * @param string $extractDirPath
     *
     * @return array
     */
    public function validateTheme(string $extractDirPath) : array
    {
        $rootFiles   = scandir($extractDirPath);
        $jsonContent = [];

        foreach ($rootFiles as $file) {
            if ('theme.json' != $file) {
                continue;
            }

            $themeJsonPath = $extractDirPath . DIRECTORY_SEPARATOR . $file;
            $jsonContent   = $this->readThemeJson($themeJsonPath);
        }

        return $jsonContent;
    }

    /**
     * Read theme json.
     *
     * @param string $themJsonPath
     *
     * @return array
     */
    public function readThemeJson(string $themJsonPath)
    {
        $themeContent = json_decode(file_get_contents($themJsonPath), true);

        if (!empty($themeContent['slug'])) {
            $themeContent['slug'] = str_slug($themeContent['slug']);
        }

        return $themeContent;
    }

    /**
     * Move to them directory.
     *
     * @param array  $themeContent
     * @param string $extractDirPath
     * @param string $themeDirPath
     *
     * @return void
     */
    public function moveToThemeDir(array $themeContent, string $extractDirPath, string $themeDirPath)
    {
        $newThemeDirName = $themeDirPath . DIRECTORY_SEPARATOR . $themeContent['slug'];

        if (is_dir($newThemeDirName)) {
            $exceptionMessage = "Theme {$themeContent['slug']} is already exists, please delete and install.";

            throw new ThemeAlreadyExistsException($exceptionMessage);
        }

        return rename($extractDirPath, $newThemeDirName);
    }

    /**
     * Delete theme file.
     *
     * @param string $themeName
     *
     * @return bool
     */
    public function deleteTheme(string $themeName) : bool
    {
        $themeDir = $this->themeDirPath . DIRECTORY_SEPARATOR . $themeName;

        if (!is_dir($themeDir)) {
            return false;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($themeDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            $rmFunction = ($file->isDir() ? 'rmdir' : 'unlink');
            $rmFunction($file);
        }

        rmdir($themeDir);

        return !is_dir($themeDir);
    }
}
