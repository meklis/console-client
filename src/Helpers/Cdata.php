<?php

namespace Meklis\Network\Console\Helpers;

class Cdata extends DefaultHelper
{
    protected $prompt = '^(.*?More.*)?([A-z_0-9]{1,3}.*).*[>#]$';
    protected $userPrompt = 'name:';
    protected $passwordPrompt = 'password:';
    protected $afterLoginCommands = [];
    protected $enableMagicControl = false;
    protected $eol = "\r\n";
    protected $beforeLogoutCommands = [];
    protected $paginationDetect = '/--More.*--/';

    public function isDoubleLoginPrompt(): bool
    {
        if ($this->connectionType === 'ssh') {
            return true;
        }
        return $this->doubleLoginPrompt;
    }
}