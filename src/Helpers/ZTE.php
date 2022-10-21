<?php

namespace Meklis\Network\Console\Helpers;

class ZTE extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Username:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [
        'terminal length 0'
    ];
    protected $eol = "\r\n";
    protected $beforeLogoutCommands = [
        ['command'=>'exit','no_wait'=>true,'usleep'=>1000],
        ['command'=>'yes','no_wait'=>true,'usleep'=>1000],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $stripPrompt = false;
    protected $windowSize = [
        1024,
        512
    ];
}