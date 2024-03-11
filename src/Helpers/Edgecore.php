<?php

namespace Meklis\Network\Console\Helpers;

class Edgecore extends DefaultHelper
{
    protected $prompt = '^.*[$|#]';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [
        'screen-length 0 temporary'
    ];
    protected $beforeLogoutCommands = [];
    protected $eol = "\r\n";
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = null;
}