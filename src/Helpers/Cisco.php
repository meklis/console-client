<?php

namespace Meklis\Network\Console\Helpers;

class Cisco extends DefaultHelper
{
    protected $prompt = '[>#] ';
    protected $userPrompt = '(sername|ogin): ';
    protected $passwordPrompt = 'Password: ';
    protected $afterLoginCommands = [
        'terminal length 0'
    ];
    protected $eol = "\n";
    protected $beforeLogoutCommands = [
        ['command'=>'exit','no_wait'=>true,'usleep'=>2000],
        ['command'=>'yes','no_wait'=>true,'usleep'=>2000],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $stripPrompt = true;
    protected $windowSize = null;
}