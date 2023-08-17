<?php

namespace Meklis\Network\Console\Helpers;

class Dlink extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = '(ame|login):';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [
        'disable cli'
    ];
    protected $beforeLogoutCommands = [];
    protected $eol = "\r\n";
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
//    protected $windowSize = [
//        1024,
//        500
//    ];
}