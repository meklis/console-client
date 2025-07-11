<?php

namespace Meklis\Network\Console\Helpers;

class Eltex extends DefaultHelper
{
    protected $prompt = '[#]$';
	protected $eol = "\n";
    protected $userPrompt = '(Name:|login:)\s*';
    protected $passwordPrompt = 'Password:\s*';
    protected $afterLoginCommands = [
        'set cli pagination off',
        'configure',
        'no logging console',
        'exit',
//        'terminal datadump',
//        'terminal width 512',
    ];
    protected $beforeLogoutCommands = [
        ['command' => 'no terminal datadump', 'no_wait' => true],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = true;
    protected $windowSize = [512, 500];


    protected $waitingResponseTimeout = 1;

    function getWaitingResponseTimeout()
    {
        if ($this->waitingResponseTimeout  ) {
            return $this->waitingResponseTimeout;
        }
        return null;
    }

}
