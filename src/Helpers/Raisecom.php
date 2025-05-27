<?php

namespace Meklis\Network\Console\Helpers;

class Raisecom extends DefaultHelper
{
    protected $userPrompt = 'Login:';
    protected $passwordPrompt = 'Password:';
    protected $prompt = '#$';
    protected $afterLoginCommands = [
    ];
    protected $beforeLogoutCommands = [];
    protected $eol = "\n";
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = null;
}
