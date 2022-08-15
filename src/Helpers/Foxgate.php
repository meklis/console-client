<?php

namespace Meklis\Network\Console\Helpers;

class Foxgate extends DefaultHelper
{
    protected $prompt = '[>#]';
	protected $eol = "\r\n";
    protected $userPrompt = ':';
    protected $passwordPrompt = ':';
    protected $afterLoginCommands = [
        'enable',
        'terminal length 0',
    ];
    protected $beforeLogoutCommands = [
        ['command' => 'exit', 'no_wait' => true],
        ['command' => 'exit', 'no_wait' => true],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
}