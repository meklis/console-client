<?php

namespace Meklis\Network\Console\Helpers;

class Cdata extends DefaultHelper
{
    protected $prompt = '^(.*?More.*)|([0-9A-Za-z _\-"\(\)]{1,}[>#])$';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'assword:';
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