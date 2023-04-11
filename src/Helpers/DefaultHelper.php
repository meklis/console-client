<?php

namespace Meklis\Network\Console\Helpers;

class DefaultHelper implements HelperInterface
{
    protected $prompt = '[%>#$]';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'ord:';
    protected $stripPrompt = true;
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $doubleLoginPrompt = false;
    protected $enableMagicControl = false;
    protected $eol = "\n";
    protected $connectionType;
    protected $windowSize = null;
    protected $paginationDetect = '';

    protected $ignoreEOF = false;

    /**
     * @return string
     */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * @return bool
     */
    public function isStripPrompt(): bool
    {
        return $this->stripPrompt;
    }

    /**
     * @param bool $stripPrompt
     * @return DefaultHelper
     */
    public function setStripPrompt(bool $stripPrompt): DefaultHelper
    {
        $this->stripPrompt = $stripPrompt;
        return $this;
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

    /**
     * @param array $afterLoginCommands
     * @return DefaultHelper
     */
    public function setAfterLoginCommands(array $afterLoginCommands): DefaultHelper
    {
        $this->afterLoginCommands = $afterLoginCommands;
        return $this;
    }

    /**
     * @param array $afterLoginCommands
     * @return DefaultHelper
     */
    public function addAfterLoginCommand($command, $no_wait = false, $usleep_after = 0): DefaultHelper
    {
        $this->afterLoginCommands[] = [
            'command' => $command,
            'no_wait' => $no_wait,
            'usleep' => $usleep_after,
        ];
        return $this;
    }

    /**
     * @return string
     */
    public function getPaginationDetect(): string
    {
        return $this->paginationDetect;
    }

    /**
     * @param string $paginationDetect
     * @return DefaultHelper
     */
    public function setPaginationDetect(string $paginationDetect): DefaultHelper
    {
        $this->paginationDetect = $paginationDetect;
        return $this;
    }

    public function setEol($eol) {
        $this->eol = "\r\n";
    }

    /**
     * @return bool
     */
    public function isIgnoreEOF(): bool
    {
        return $this->ignoreEOF;
    }

    /**
     * @param bool $ignoreEOF
     * @return DefaultHelper
     */
    public function setIgnoreEOF(bool $ignoreEOF): DefaultHelper
    {
        $this->ignoreEOF = $ignoreEOF;
        return $this;
    }



}