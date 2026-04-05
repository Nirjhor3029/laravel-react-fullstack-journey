<?php

class Configuration
{
    public static $appName = 'MyApp';
    public static $version = '1.0.0';

    public static function getAppInfo()
    {
        return self::$appName . ' v' . self::$version;
    }

    public  function getAppInfo2()
    {
        return $this->appName . ' v' . self::$version;
    }
}

// Access without creating object
echo Configuration::$appName;           // MyApp
echo Configuration::getAppInfo();        // MyApp v1.0.0

echo "<br>";
$c = new Configuration();
echo $c->getAppInfo2();