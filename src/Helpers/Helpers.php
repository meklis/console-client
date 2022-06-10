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
        'zte' => ZTE::class,
        'huawei' => Huawei::class,
    ];

    /**
     * @param $name
     * @return HelperInterface
     * @throws \Exception
     */
    public static function getByName($name)
    {
        if (!isset(self::$helpers[$name])) {
            throw new \Exception("Helper with name $name not found");
        }
        return new self::$helpers[$name]();
    }
}