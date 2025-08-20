<?php

namespace Meklis\Network\Console\Helpers;

class Junos extends DefaultHelper
{
    protected $prompt = '^([A-Za-z0-9_-]{3,})@.*?[>#]$';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = null;
}