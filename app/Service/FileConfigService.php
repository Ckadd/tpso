<?php

namespace App\Service;

class FileConfigService
{
    protected $configBasePath;

    public function __construct()
    {
        $this->configBasePath = storage_path('app') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
        $this->createConfigDir();
    }

    /**
     * Get file config by key.
     *
     * @param string $configKey
     *
     * @return mixed
     */
    public function get(string $configKey)
    {
        $config = $this->sanitizeConfig($configKey);

        if (!$this->isConfigFileExists($config['file'])) {
            return null;
        }

        $configContent = $this->getConfigFromFile($config['file']);

        if (empty($config['value'])) {
            return $configContent;
        }

        return array_get($configContent, $config['value']);
    }

    /**
     * Set config value.
     *
     * @param string $configKey
     * @param mixed  $value
     *
     * @return array
     */
    public function set(string $configKey, $value)
    {
        $config         = $this->sanitizeConfig($configKey);
        $previousConfig = $this->getConfigFromFile($config['file']);

        if (empty($previousConfig)) {
            $previousConfig = [];
        }

        if (empty($config['value'])) {
            $config['value'] = $value;
        }

        $newConfig = array_set($previousConfig, $config['value'], $value);
        $this->writeConfigToFile($config['file'], $newConfig);

        return $previousConfig;
    }

    /**
     * Write config to file.
     *
     * @param string $configKeyFile
     * @param array  $value
     *
     * @return void
     */
    public function writeConfigToFile(string $configKeyFile, array $value)
    {
        return file_put_contents($this->getConfigFilePath($configKeyFile), json_encode($value));
    }

    /**
     * Get config from fiel.
     *
     * @param string $configKeyFile
     *
     * @return array
     */
    public function getConfigFromFile(string $configKeyFile)
    {
        if (!file_exists($this->getConfigFilePath($configKeyFile))) {
            file_put_contents($this->getConfigFilePath($configKeyFile), '');
        }

        return json_decode(file_get_contents($this->getConfigFilePath($configKeyFile)), true);
    }

    /**
     * Sanitize config dot.
     *
     * @param string $configKey
     *
     * @return array
     */
    public function sanitizeConfig(string $configKey) : array
    {
        $configLevel = explode('.', $configKey);
        $file        = empty($configLevel[0]) ? '' : $configLevel[0];
        unset($configLevel[0]);

        $value = implode('.', $configLevel);

        return [
            'file'  => $file,
            'value' => $value,
        ];
    }

    /**
     * Create config directory.
     *
     * @return void
     */
    private function createConfigDir()
    {
        if (!is_dir($this->configBasePath)) {
            mkdir($this->configBasePath);
        }
    }

    /**
     * Get config file path.
     *
     * @param string $configKey
     *
     * @return string
     */
    private function getConfigFilePath(string $configKey) : string
    {
        return $this->configBasePath . $configKey . '.json';
    }

    /**
     * Check is config file exists.
     *
     * @param string $configFile
     *
     * @return bool
     */
    private function isConfigFileExists(string $configFile) : bool
    {
        return file_exists($this->getConfigFilePath($configFile));
    }
}
