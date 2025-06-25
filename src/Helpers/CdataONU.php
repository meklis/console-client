<?php

namespace Meklis\Network\Console\Helpers;

class CdataONU extends DefaultHelper
{
    protected $prompt = '^MDU(\(config\))?[>#]$';
    protected $userPrompt = 'login:';
    protected $passwordPrompt = 'password:';
    protected $afterLoginCommands = [];
    protected $enableMagicControl = false;
    protected $eol = "\n";
    protected $beforeLogoutCommands = [];
//    protected $paginationDetect = '/--More.*$/';

    public function isDoubleLoginPrompt(): bool
    {
        if ($this->connectionType === 'ssh') {
            return true;
        }
        return $this->doubleLoginPrompt;
    }
}
