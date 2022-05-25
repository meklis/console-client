<?php

namespace Meklis\Network\Console\Helpers;

class DefaultHelper implements HelperInterface
{
    protected $prompt = '[%>#$]';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $eol = "\n";
    protected $connectionType;
    protected $windowSize = [
        1024,
        500
    ];

    /**
     * @return string
     */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * @return string
     */
    public function getUserPrompt()
    {
        return $this->userPrompt;
    }

    /**
     * @return string
     */
    public function getPasswordPrompt()
    {
        return $this->passwordPrompt;
    }

    /**
     * @return array
     */
    public function getAfterLoginCommands()
    {
        return $this->afterLoginCommands;
    }


    /**
     * @return array
     */
    public function getBeforeLogoutCommands()
    {
        return $this->beforeLogoutCommands;
    }


    /**
     * @return bool
     */
    public function isDoubleLoginPrompt()
    {
        return $this->doubleLoginPrompt;
    }


    /**
     * @return bool
     */
    public function isEnableMagicControl()
    {
        return $this->enableMagicControl;
    }

    /**
     * @return string
     */
    public function getEol()
    {
        return $this->eol;
    }

    /**
     * @return int[] | null
     */
    public function getWindowSize()
    {
        return $this->windowSize;
    }

    /**
     * @return mixed
     */
    public function getConnectionType()
    {
        return $this->connectionType;
    }

    /**
     * @param mixed $connectionType
     * @return DefaultHelper
     */
    public function setConnectionType($connectionType)
    {
        $this->connectionType = $connectionType;
        return $this;
    }

}