<?php

namespace Bot\Config;

/**
 * Class Config is a class for reading data from a configuration file
 */
class Config
{
    /**
     * @var array $config Array of configuration readed from config.ini
     */
    private static array $config;

    /**
     * Read and save array of config
     * @param string $config
     */
    public static function init(string $config): void
    {
        try {
            if (!file_exists($config)) throw new \Exception('Missing config file: ' . $config);

            self::$config = parse_ini_file($config);
        }
        catch (\Exception $e)
        {
            die($e->getMessage());
        }
    }


    /**
     * Get value of config array by key
     * @param string $key
     * @throws \Exception
     */
    public static function get(string $key): mixed
    {
        if (!isset(self::$config[$key])) throw new \Exception('Missing key in config: '. $key);

        return self::$config[$key];
    }
}
