<?php

namespace Meklis\Network\Console\Helpers;

class ZteC220 extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Username:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [
       ['command'=>'exit','no_wait'=>true,'usleep'=>1000],
       ['command'=>'yes','no_wait'=>true,'usleep'=>1000],
       ['command'=>'logo','no_wait'=>true,'usleep'=>1000],
       ['command'=>'yes','no_wait'=>true,'usleep'=>1000],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $paginationDetect = '/--More--/';
    protected $windowSize = [
        1024,
        512
    ];

}