<?php

namespace Meklis\Network\Console\Helpers;

class Stels extends DefaultHelper
{
    protected $prompt = '([A-z_0-9]{1,30})[>#]';
    protected $userPrompt = 'Username:';
    protected $passwordPrompt = 'Password:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $windowSize = null;
    protected $paginationDetect = '/--More.*--/';

    public function isDoubleLoginPrompt(): bool
    {
        if ($this->connectionType === 'ssh') {
            return true;
        }
        return $this->doubleLoginPrompt;
    }
}