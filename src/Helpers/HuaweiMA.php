<?php

namespace Meklis\Network\Console\Helpers;

class HuaweiMA extends DefaultHelper
{
    protected $prompt = '^[^{}].*?[>#]$';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [
        "enable",
        "scroll\r\n\r\n"
    ];
    protected $beforeLogoutCommands = [
        ['command' => 'quit', 'no_wait' => true, 'usleep' => 1000],
        ['command' => 'y', 'no_wait' => true],
    ];
    protected $eol = "\r\n";
    protected $doubleLoginPrompt = true;
    protected $enableMagicControl = false;
    protected $paginationDetect = '/---- More.*----/';
    protected $windowSize = null;
    protected $waitingResponseTimeout = 0.5;

    function getWaitingResponseTimeout()
    {
        if ($this->waitingResponseTimeout && $this->connectionType === 'ssh') {
            return $this->waitingResponseTimeout;
        }
        return null;
    }

    /**
     * @return string
     */
    public function getPrompt()
    {
        if ($this->connectionType === 'ssh') return '';
        return $this->prompt;
    }

}