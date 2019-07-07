<?php

namespace App\Traits;

trait ThemeEditorTrait
{
    /**
     * Read file.
     *
     * @param string $filePath
     *
     * @return void
     */
    public function readFile(string $filePath)
    {
        if (!$this->isFileExists($filePath)) {
            return false;
        }

        return file_get_contents($filePath);
    }

    /**
     * Write file.
     *
     * @param string $filePath
     * @param string $fileContent
     *
     * @return void
     */
    public function writeFile(string $filePath, string $fileContent)
    {
        if (!$this->isFileExists($filePath)) {
            return false;
        }

        return file_put_contents($filePath, $fileContent);
    }

    /**
     * Check is file exists.
     *
     * @param string $filePath
     *
     * @return bool
     */
    private function isFileExists(string $filePath) : bool
    {
        return file_exists($filePath);
    }

    /**
     * Get full file path.
     *
     * @param string $dirPath
     * @param string $filePath
     *
     * @return void
     */
    public function getFullPath(string $dirPath, string $filePath) : string
    {
        return $dirPath . DIRECTORY_SEPARATOR . ltrim($filePath, DIRECTORY_SEPARATOR);
    }

    /**
     * Encode path.
     *
     * @param string $path
     *
     * @return string
     */
    public function encodePath(string $path) : string
    {
        return base64_encode($path);
    }

    /**
     * Decode path.
     *
     * @param string $encodedPath
     *
     * @return string
     */
    public function decodePath(string $encodedPath) : string
    {
        return base64_decode($encodedPath);
    }
}
