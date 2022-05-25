<?php

namespace Meklis\Network\Console\Helpers;

class Junos extends DefaultHelper
{
    protected $prompt = '[>%#]';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
}