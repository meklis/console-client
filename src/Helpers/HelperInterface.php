<?php

namespace Meklis\Network\Console\Helpers;

interface HelperInterface
{

    /**
     * @return string
     */
    public function getPrompt();

    /**
     * @return string
     */
    public function getUserPrompt();

    /**
     * @return string
     */
    public function getPasswordPrompt();

    /**
     * @return array
     */
    public function getAfterLoginCommands();


    /**
     * @return array
     */
    public function getBeforeLogoutCommands();

    /**
     * @return bool
     */
    public function isDoubleLoginPrompt();


    /**
     * @return bool
     */
    public function isEnableMagicControl();

    /**
     * @return string
     */
    public function getEol();

    /**
     * @return int[] | null
     */
    public function getWindowSize();


    /**
     * @return mixed
     */
    public function getConnectionType();

    /**
     * @param mixed $connectionType
     * @return DefaultHelper
     */
    public function setConnectionType($connectionType);
}