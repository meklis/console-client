<?php

namespace Meklis\Network\Console\Helpers;

class Bdcom extends DefaultHelper
{
    protected $prompt = '[>#]';
    protected $userPrompt = 'name:';
    protected $passwordPrompt = 'assword:';
    protected $afterLoginCommands = [
        'enable',
        'config',
        'terminal length 0',
    ];
    protected $beforeLogoutCommands = [
        ['command' => 'exit', 'no_wait' => true],
        ['command' => 'exit', 'no_wait' => true],
        ['command' => 'exit', 'no_wait' => true],
    ];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $windowSize = null;
}
