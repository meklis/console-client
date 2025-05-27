<?php

namespace Meklis\Network\Console\Helpers;

class Raisecom extends DefaultHelper
{
    protected $userPrompt = 'ogin:';
    protected $passwordPrompt = 'Password:';
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
