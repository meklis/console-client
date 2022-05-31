<?php

namespace Meklis\Network\Console\Helpers;

class ZTE extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Username:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [
        'terminal length 0'
    ];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = [
        1024,
        512
    ];
}