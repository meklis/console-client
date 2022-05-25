<?php

namespace Meklis\Network\Console\Helpers;

class Bdcom extends DefaultHelper
{
    protected $prompt = ' [>#] ';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
}