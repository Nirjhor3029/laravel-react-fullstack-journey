<?php

class Config
{
    public static $appName = "FullstackApp";
    public static $version = "1.0.0";

    public static function getAppName()
    {
        return self::$appName;
    }

    public static function getVersion()
    {
        return self::$version;
    }
}

// Access without creating object
echo Config::$appName;      // FullstackApp
echo Config::getAppName();  // FullstackApp
echo Config::getVersion();  // 1.0.0