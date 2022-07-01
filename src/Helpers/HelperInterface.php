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
     * @return self
     */
    public function setConnectionType($connectionType);


    /**
     * @param array $afterLoginCommands
     * @return self
     */
    public function setAfterLoginCommands(array $afterLoginCommands);

    /**
     * @param $command
     * @param $no_wait
     * @param $usleep_after
     * @return self
     */
    public function addAfterLoginCommand($command, $no_wait = false, $usleep_after = 0);


    public function getPaginationDetect();
    public function setPaginationDetect(string $paginationDetect);
}