<?php

namespace Meklis\Network\Console\Helpers;

class Gcom extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'Username\(.*?\):';
    protected $passwordPrompt = 'Password\(.*?\):';
    protected $afterLoginCommands = [
        'enable'
    ];
    protected $beforeLogoutCommands = [
        ['command'=>'exit','no_wait'=>true,'usleep'=>10],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
    protected $paginationDetect = '/\.\.\.\.press ENTER to next line.*\.\.\.\./';
}
