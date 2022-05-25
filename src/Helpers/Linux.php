<?php

namespace Meklis\Network\Console\Helpers;

class Linux extends DefaultHelper
{
    protected $prompt = '\$';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [
        'disable cli'
    ];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
}