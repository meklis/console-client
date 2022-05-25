<?php

namespace Meklis\Network\Console\Helpers;

class Ios extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Username:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = [
        255,
        120
    ];
}