<?php

namespace Meklis\Network\Console\Helpers;

class Xos extends DefaultHelper
{
    protected $prompt = '[0-9A-Za-z\-\._]{1,} [>#]';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [
        'exit'
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = null;
}