<?php

namespace Meklis\Network\Console\Helpers;

class Cdata extends DefaultHelper
{
    protected $prompt = '([A-z0-9]{1,3}.*).*[>#]$';
    protected $userPrompt = 'name:';
    protected $passwordPrompt = 'password:';
    protected $afterLoginCommands = [];
    protected $enableMagicControl = false;
    protected $eol = "\n";
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