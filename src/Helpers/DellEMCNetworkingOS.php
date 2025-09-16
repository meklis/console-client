<?php

namespace Meklis\Network\Console\Helpers;

class DellEMCNetworkingOS extends DefaultHelper
{
    protected $prompt = '^[a-zA-Z0-9\_\-]*[>#]$';
    protected $userPrompt = '.*(ame|ogin):';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [
          'terminal length 0',
    ];
    protected $beforeLogoutCommands = [];
    protected $eol = "\r\n";
    protected $doubleLoginPrompt = true;
    protected $enableMagicControl = true;

    protected $paginationDetect = '/More/';
    protected $windowSize = null;
}
