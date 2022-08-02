<?php

namespace Meklis\Network\Console\Helpers;

class Vsolution extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Login:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [
    ];
    protected $beforeLogoutCommands = [
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = [
        1024,
        512
    ];
}
