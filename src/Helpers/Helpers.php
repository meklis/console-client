<?php

namespace Meklis\Network\Console\Helpers;

class Helpers
{
    protected static $helpers = [
        'default' => DefaultHelper::class,
        'dlink' => Dlink::class,
        'alaxala' => Alaxala::class,
        'bdcom' => Bdcom::class,
        'cdata' => Cdata::class,
        'ios' => Ios::class,
        'junos' => Junos::class,
        'linux' => Linux::class,
        'xos' => Xos::class,
    ];

    public static function getByName($name)
    {
        if (!isset(self::$helpers[$name])) {
            throw new \Exception("Helper with name $name not found");
        }
        return self::$helpers[$name];
    }
}