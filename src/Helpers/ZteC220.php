<?php

namespace Meklis\Network\Console\Helpers;

class ZteC220 extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Username:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $paginationDetect = '/--More--/';
    protected $windowSize = [
        1024,
        512
    ];

}