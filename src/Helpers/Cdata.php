<?php

namespace Meklis\Network\Console\Helpers;

class Cdata extends DefaultHelper
{
    protected $prompt = 'OLT(.*?)[>#]';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $windowSize = null;

    public function isDoubleLoginPrompt(): bool
    {
        if ($this->connectionType === 'ssh') {
            return true;
        }
        return $this->doubleLoginPrompt;
    }
}