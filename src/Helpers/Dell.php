<?php

namespace Meklis\Network\Console\Helpers;

class Dell extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = '.*(ame|login):';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [
        'terminal datadump'
    ];
    protected $beforeLogoutCommands = [];
    protected $eol = "\r\n";
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;

    protected $paginationDetect = '/More/';
    protected $windowSize = null;
}