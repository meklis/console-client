<?php

namespace Meklis\Network\Console\Helpers;

class Xos extends DefaultHelper
{
    protected $prompt = '\.[0-9]{1,3} [>#] ';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
}