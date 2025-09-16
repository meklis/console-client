<?php

namespace Meklis\Network\Console\Helpers;

class Helpers
{
    protected static $helpers = [
        'default' => DefaultHelper::class,
        'raisecom' => Raisecom::class,
        'dlink' => Dlink::class,
        'alaxala' => Alaxala::class,
        'arista' => Arista::class,
        'bdcom' => Bdcom::class,
        'cdata' => Cdata::class,
        'cdata-onu' => CdataONU::class,
        'dcn' => DCN::class,
        'ios' => Ios::class,
        'junos' => Junos::class,
        'linux' => Linux::class,
        'xos' => Xos::class,
        'zte' => ZTE::class,
        'zte_с220' => ZteC220::class,
        'huawei' => Huawei::class,
        'huawei_ma' => HuaweiMA::class,
        'stels' => Stels::class,
        'vsolution' => Vsolution::class,
        'foxgate' => Foxgate::class,
        'tplink' => TpLink::class,
        'tplinkold' => TpLinkOld::class,
        'edge-core' => Edgecore::class,
        'gcom' => Gcom::class,
        'alcatel' => Alcatel::class,
        'dell' => Dell::class,
        'dell_emc_networking_os' => DellEMCNetworkingOS::class,
        'eltex' => Eltex::class,
        'cisco' => Cisco::class,
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
