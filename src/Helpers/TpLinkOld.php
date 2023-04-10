<?php

namespace Meklis\Network\Console\Helpers;

class TpLinkOld extends DefaultHelper
{
    protected $prompt = '[>#]';
	  protected $eol = "\r\n";
    protected $userPrompt = ':';
    protected $passwordPrompt = ':';
    protected $afterLoginCommands = [
        ' ',
        'enable',
    ];
    protected $beforeLogoutCommands = [
        ['command' => 'exit', 'no_wait' => true],
        ['command' => 'exit', 'no_wait' => true],
    ];
    protected $doubleLoginPrompt = true;
    protected $enableMagicControl = false;
    protected $paginationDetect = '/Press any key to continue/';

    protected $windowSize = null;
}
