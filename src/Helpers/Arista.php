<?php

namespace Meklis\Network\Console\Helpers;

class Arista extends DefaultHelper
{
    //protected $userPrompt = 'Username:';
    //protected $passwordPrompt = 'Password:';
    protected $prompt = '^[A-Za-z0-9_-]{1,}[>#]';
    protected $afterLoginCommands = [
        'terminal length 0',
    ];
    protected $beforeLogoutCommands = [];
    protected $eol = "\n";
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = null;
}
